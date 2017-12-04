<?php
/**
 * TrcIMPLAN Central - SMILanzadera PublicadorSMI
 *
 * Copyright (C) 2017 Guillermo Valdés Lozano
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

namespace SMILanzadera;

/**
 * Clase PublicadorSMI
 *
 * Proceso principal que es ejecutado desde el script en bin
 */
class PublicadorSMI extends Publicador {

    // public $mensajes;
    // protected $sesion;
    // protected $sitio_web_directorio;
    // protected $filtro_categorias;
    // protected $filtro_fuentes;
    // protected $filtro_regiones;

    /**
     * Publicar
     *
     * @return string Mensajes para la terminal
     */
    public function publicar() {
        // Anteriormente sólo se consultaban las regiones metropolitanas
    //~ $regiones = new RegionesMetropolitanasListado($this->sesion);
        // Consultar todas las regiones
        $regiones          = new \CatRegiones\Listado($this->sesion);
        $regiones->estatus = 'A';
        $regiones->consultar();
        // Consultar subíndices
        $subindices          = new \IndSubindices\Listado($this->sesion);
        $subindices->estatus = 'A'; // EN USO
        $subindices->consultar();
        // Iniciar FichaPHP
        $ficha_php = new FichaPHP($this->sesion);
        $ficha_php->definir_filtro_categorias($this->filtro_categorias);
        $ficha_php->definir_filtro_fuentes($this->filtro_fuentes);
        $ficha_php->definir_filtro_regiones($this->filtro_regiones);
        // Bucle por las regiones
        foreach ($regiones->listado as $r) {
            // Acumular mensajes
            $this->mensajes[] = "SMILanzadera {$r['nombre']}";
            echo "SMILanzadera {$r['nombre']} ";
            // Consultar región
            $region = new \CatRegiones\Registro($this->sesion);
            $region->consultar($r['id']);
            // Eliminar directorio y sus archivos
            $espacio = sprintf('SMIIndicadores%s', \Base2\UtileriasParaFormatos::caracteres_para_clase($region->nombre));
            $this->eliminar_directorio("lib/$espacio");
            // Bucle por los subíndices
            $contador = 0;
            foreach ($subindices->listado as $s) {
                // Cargar indicadores
                $indicadores            = new \IndIndicadores\Listado($this->sesion);
                $indicadores->estatus   = 'A'; // EN USO
                $indicadores->subindice = $s['id'];
                try {
                    $indicadores->consultar();
                } catch (\Base2\ListadoExceptionVacio $e) {
                    continue; // El subíndice NO tiene indicadores, se salta
                }
                // Bucle en indicadores
                foreach ($indicadores->listado as $i) {
                    // Crear ficha
                    try {
                        $ficha_php->consultar($r['id'], $i['id']);
                    } catch (FichaExceptionVacio $e) {
                        continue; // No hay datos para elaborarlo, se salta
                    } catch (\Exception $e) {
                        $this->mensajes[] = sprintf('  FALLÓ %s / %s: %s', $region->nombre, $i['nombre'], $e->getMessage());
                        continue;
                    }
                    $this->crear_archivo($ficha_php->ruta(), $ficha_php->php());
                    // Acumular mensajes
                    $this->mensajes[] = sprintf('  %s', $ficha_php->ruta());
                    echo ".";
                    $contador++;
                } // bucle en indicadores
            } // bucle por los subíndices
            // Crear la imprenta para esta región si hubo fichas
            if ($contador > 0) {
                $elaborador_imprenta_php = new ElaboradorPHPImprenta($this->sesion);
                $elaborador_imprenta_php->definir_region($region);
                $elaborador_imprenta_php->definir_espacio($espacio);
                $this->crear_archivo($elaborador_imprenta_php->ruta(), $elaborador_imprenta_php->php());
                // Acumular mensajes
                $this->mensajes[] = sprintf('  %s', $elaborador_imprenta_php->ruta());
                echo "i $contador";
            } else {
                echo "sin publicaciones";
            }
            echo "\n";
        } // bucle por las regiones
        // Entregar mensajes
        return implode("\n", $this->mensajes);
    } // publicar

} // Clase PublicadorSMI

?>
