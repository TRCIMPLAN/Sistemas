<?php
/**
 * TrcIMPLAN Central - Categorías Vínculos Relacionados
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

namespace CatCategoriasVinculos;

/**
 * Clase Relacionados
 */
class Relacionados {

    public $region_nivel;          // Nivel de la Región, para darle preferencia a las publicaciones de la misma región
    public $categorias;            // Texto, nombres de las categorias del indicador separadas por comas
    public $directorio;            // Nombre del directorio donde se depositará el archivo HTML
    public $archivo;               // Nombre que tendrá el archivo HTML, sin .html
    public $listado;               // Arreglo con los resultados de la consulta
    public $panal;                 // Arreglo con los resultados de la consulta, donde cada celda es instancia de Celda
    public $estructura    = array(
        'creado'      => array('enca' => 'Creado',      'ancho' => 10, 'formato' => 'fecha'),
        'tipo'        => array('enca' => 'Tipo',        'ancho' => 16, 'formato' => 'caracter'),
        'nombre'      => array('enca' => 'Nombre',      'ancho' => 48, 'formato' => 'texto'),
        'descripcion' => array('enca' => 'Descripción', 'ancho' => 64, 'formato' => 'texto'));
    protected $sesion;             // Instancia con la Sesión
    protected $consultado = false; // Bandera, verdadero si ya se consultó
    static public $limite = 20;    // Cantidad límite de renglones

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // constructor

    /**
     * Consultar
     */
    public function consultar() {
        // Si ya se consultó, no hacer nada
        if ($this->consultado) {
            return;
        }
        // Definir el vínculo de ESTA página web, para omitirlo de los relacionados
        $esta_pagina_web = sprintf('%s/%s.html', $this->directorio, $this->archivo);
        // Como una publicación puede estar en varias categorias
        $vinculos = array();
        // En este arreglo acumularemos los renglones para el listado
        $a = array();
        // Si categorías está definido
        if (is_string($this->categorias) && (trim($this->categorias) != '')) {
            // Bucle por las categorías
            foreach (explode(',', $this->categorias) as $c) {
                // Consultar los vínculos de cada categoría
                $categorias_vinculos                   = new \CatCategoriasVinculos\Listado($this->sesion);
                $categorias_vinculos->categoria_nombre = trim($c);
                $categorias_vinculos->estatus          = 'A';
                try {
                    $categorias_vinculos->consultar();
                } catch (\Exception $e) {
                    throw $e;
                }
                // Bucle por los vínculos
                foreach ($categorias_vinculos->listado as $v) {
                    // Si NO es esta misma página y para evitar que se dupliquen
                    if (($v['vinculo'] != $esta_pagina_web) && !in_array($v['vinculo'], $vinculos)) {
                        // Si es de la misma región
                        if ($v['region_nivel'] == $this->region_nivel) {
                            // Acumular si es de la misma región
                            $a[]        = $v;
                            $vinculos[] = $v['vinculo'];
                        } elseif ($v['region_nivel'] == 0) {
                            // Acumular si NO tiene región
                            $a[]        = $v;
                            $vinculos[] = $v['vinculo'];
                        }
                    }
                }
            }
        }
        // Levantar la bandera
        $this->consultado = true;
        // Definir listado
        $this->listado    = $a;
    } // consultar

    /**
     * Formatear
     */
    public function formatear() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en Relacionados: No ha ejecutado la consulta.");
        }
        if (!is_array($this->listado)) {
            throw new \Exception("Error en Relacionados: No hay datos en listado.");
        }
        // Definir la zona horaria
        $zona_horaria = new \DateTimeZone('America/Monterrey');
        // Acumularemos los renglones en este arreglo
        $renglones = array();
        // Bucle en listado
        foreach ($this->listado as $d) {
            // Para que el orden sea cronológicamente inverso, se calcula la antigüedad
            $creado_fecha     = new \DateTime($d['creado'], $zona_horaria);
            $creado_timestamp = $creado_fecha->getTimestamp();
            $antiguedad       = sprintf('%012d', time() - $creado_timestamp);
            // La clave del arreglo asociativo servirá para ordenarla
            $clave = "$antiguedad {$d['nombre']}";
            // Celda creado
            //$creado_celda = new \Base\Celda($fecha->getTimestamp());
            //$creado_celda->formatear_cantidad();
            if ($creado_timestamp < 946645199) {
                $creado_celda = new \Base\Celda('nd');
            } else {
                $creado_celda = new \Base\Celda($d['creado']);
                $creado_celda->formatear_fecha();
            }
            // Celda tipo
            $tipo_celda = new \Base\Celda($d['tipo']);
            $tipo_celda->formatear_caracter(\CatCategoriasVinculos\Registro::$tipo_descripciones);
            // Celda nombre
            $nombre_celda          = new \Base\Celda($d['nombre']);
            $nombre_celda->vinculo = '../'.$d['vinculo'];
            // Acumular, respeta las columnas de la estructura declarada (excepto region y dato)
            $renglones[$clave] = array(
                'creado'      => $creado_celda,
                'tipo'        => $tipo_celda,
                'nombre'      => $nombre_celda,
                'descripcion' => $d['descripcion']);
        }
        // Ordenar por la clave, será del más antiguo al más viejo
        ksort($renglones);
        // Definir propiedad panal
        $this->panal = array();
        $contador    = 0;
        foreach ($renglones as $clave => $arreglo) {
            $this->panal[$clave] = $arreglo;
            $contador++;
            if ($contador >= self::$limite) {
                break;
            }
        }
    } // formatear

} // Clase Relacionados

?>
