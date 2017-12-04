<?php
/**
 * TrcIMPLAN Central - OrgVinculos Recolector
 *
 * Copyright (C) 2016 Guillermo Valdés Lozano
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package TrcIMPLANCentral
 */

namespace OrgVinculos;

/**
 * Clase Recolector
 */
class Recolector {

    protected $vinculos      = array();               // Arreglo con instancias de Registro
    protected $sitio_web_dir = 'lib/OrgSitioWeb/lib'; // Ruta relativa desde htdocs/bin para cargar las publicaciones

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // constructor

    /**
     * Recolectar archivos
     *
     * @param  string Nombre del directorio (namespace) dentro del Sitio Web de donde se tomarán las publicaciones
     * @return array  Arreglo con textos de la forma Namespace\Clase
     */
    protected function recolectar_archivos($dir) {
        // Definir ruta
        $ruta = "{$this->sitio_web_dir}/$dir";
        // Si no existe
        if (!is_dir($ruta)) {
            throw new \Exception("Error en Recolector: No existe el directorio $ruta");
        }
        // Obtener el listado con los archivos PHP
        $globo = glob("$ruta/*.php");
        if ($globo === false) {
            throw new \Exception("Error en Recolector: Falló la obtención de archivos PHP en el directorio $ruta.");
        }
        if (count($globo) == 0) {
            throw new \Exception("Error en Recolector: No hay archivos PHP en el directorio $ruta.");
        }
        // Bucle en los archivos encontrados
        $a = array();
        foreach ($globo as $archivo) {
            // Definir la ruta a la clase
            $a[] = $dir.'\\'.basename($archivo, '.php');
        }
        // Entregar arreglo
        return $a;
    } // recolectar_archivos

    /**
     * Recolectar
     *
     * @return string Mensaje
     */
    public function recolectar() {
        // Que tenga permiso para ver
        if (!$this->sesion->puede_ver('org_vinculos')) {
            throw new \Exception('Aviso: No tiene permiso para ver vínculos.');
        }
        // En este arreglo acumularemos los mensajes
        $msg = array();
        // Consultar ramas
        $ramas          = new \OrgRamas\Listado($this->sesion);
        $ramas->estatus = 'A';
        $ramas->consultar(); // Puede causar una excepción
        // Bucle por las ramas
        foreach ($ramas->listado as $r) {
            // Agregar mensaje
            $msg[] = sprintf('  Rama %s', $r['namespace']);
            // Iniciar contadores
            $publicaciones_en_rama_cantidad = 0;
            // Recolectar archivos en la rama
            $archivos = $this->recolectar_archivos($r['namespace']); // Puede causar una excepción
            // Bucle por los archivos
            foreach ($archivos as $ruta_al_archivo) {
                // Iniciar un nuevo cargador, pasar la rama y el directorio al mismo
                $vinculo             = new Cargador($this->sesion);
                $vinculo->rama       = $r['id'];
                $vinculo->directorio = $r['directorio'];
                try {
                    // Cargar datos de la publicación al vínculo
                    $vinculo->cargar($ruta_al_archivo);
                    // Acumular
                    $this->vinculos[] = $vinculo;
                    // Incrementar contador
                    $publicaciones_en_rama_cantidad++;
                } catch (CargadorExceptionNoEsPublicacion $e) {
                    // No es publicación
                    $msg[] = sprintf('    %s', $e->getMessage());
                } catch (\Exception $e) {
                    throw $e;
                }
            }
            // Agregar línea a mensajes
            $msg[] = sprintf('    Tiene %d archivos de los cuales %d son publicaciones.', count($archivos), $publicaciones_en_rama_cantidad);
        }
        // Agregar último mensaje con el total
        $msg[] = sprintf('  Total %d vínculos.', count($this->vinculos));
        // Entregar mensajes
        return implode("\n", $msg);
    } // recolectar

    /**
     * Agregar
     */
    public function agregar() {
        // Que tenga permiso para agregar
        if (!$this->sesion->puede_agregar('org_vinculos')) {
            throw new \Exception('Aviso: No tiene permiso para agregar vínculos.');
        }
        // Validar propiedad vinculos
        if (!is_array($this->vinculos) || (count($this->vinculos) == 0)) {
            throw new \Exception('Error: No hay Vínculos a agregar.');
        }
        // Preparar identificadores
        $identificador_autores    = new \OrgAutores\Identificador($this->sesion);
        $identificador_categorias = new \OrgCategorias\Identificador($this->sesion);
        $identificador_fuentes    = new \OrgFuentes\Identificador($this->sesion);
        $identificador_regiones   = new \OrgRegiones\Identificador($this->sesion);
        // En este arreglo acumularemos los mensajes
        $msg = array();
        // Iniciar contadores
        $vinculos_insertados_cantidad = 0;
        // Bucle por los vínculos
        foreach ($this->vinculos as $vinculo) {
            try {
                // Agregar vínculo
                $vinculo->agregar();
                $vinculos_insertados_cantidad++;
                echo "v"; // Poner una v en la terminal
                // Identificar los autores, categorias, fuentes y regiones
                $autores    = $identificador_autores->identificar($vinculo->obtener_autores());
                $categorias = $identificador_categorias->identificar($vinculo->obtener_categorias());
                $fuentes    = $identificador_fuentes->identificar($vinculo->obtener_fuentes());
                $regiones   = $identificador_regiones->identificar($vinculo->obtener_regiones());
                // Agregar elementos
                foreach ($autores as $autor) {
                    foreach ($categorias as $categoria) {
                        foreach ($fuentes as $fuente) {
                            foreach ($regiones as $region) {
                                $elemento = new \OrgElementos\Registro($this->sesion);
                                $elemento->creado    = $vinculo->creado; // Fecha y hora de creación
                                $elemento->vinculo   = $vinculo->id;     // ID en org_vinculos
                                $elemento->autor     = $autor;           // ID en org_autores
                                $elemento->categoria = $categoria;       // ID en org_categorias
                                $elemento->fuente    = $fuente;          // ID en org_fuentes
                                $elemento->region    = $region;          // ID en org_regiones
                                $elemento->estatus   = 'A';              // En Uso
                                $elemento->agregar();
                                echo "."; // Poner un punto en la terminal
                            }
                        }
                    }
                }
            } catch (\Base\RegistroExceptionValidacion $e) {
                // Falló la validación
                $msg[] = sprintf('    En %s hubo %s', $vinculo->nombre, $e->getMessage());
                echo "x";
            } catch (\Base2\RegistroExceptionValidacion $e) {
                // Falló la validación
                $msg[] = sprintf('    En %s hubo %s', $vinculo->nombre, $e->getMessage());
                echo "x";
            } catch (\Exception $e) {
                throw $e;
            }
        }
        echo "\n";
        // Agregar último mensaje con el total
        $msg[] = sprintf('  Se agregaron %d de %d.', $vinculos_insertados_cantidad, count($this->vinculos));
        // Entregar mensajes
        return implode("\n", $msg);
    } // agregar

} // Clase Recolector

?>
