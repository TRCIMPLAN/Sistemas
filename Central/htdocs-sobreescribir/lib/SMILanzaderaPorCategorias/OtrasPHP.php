<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorCategorias Otras
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

namespace SMILanzaderaPorCategorias;

/**
 * Clase OtrasPHP
 */
class OtrasPHP extends Otras {

    // public $consultado;
    // protected $sesion;
    // public $listado;
    // public $panal;
    // public $cantidad_registros;
    // public $limit;
    // public $offset;
    // public $estructura;
    // public $categoria;
    // public $region;
    // protected $filtro_categorias;
    // protected $filtro_fuentes;
    // protected $filtro_regiones;
    public $colores = array(
        'economia'        => 'color1',
        'gobierno'        => 'color2',
        'seguridad'       => 'color3',
        'sociedad'        => 'color4',
        'sustentabilidad' => 'color5');

    /**
     * PHP
     *
     * @return string Código PHP
     */
    public function php() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en OtrasPHP: No se ha consultado.");
        }
        // Acumularemos la entrega en este arreglo
        $a = array();
        // Acumular
        $a[] = '<h3>Otras regiones</h3>';
        $a[] = '<table class="table table-hover table-bordered matriz">';
        $a[] = '<thead>';
        $a[] = '  <tr>';
        foreach ($this->estructura as $clave => $e) {
            $a[] = '    <th>'.$e['enca'].'</th>';
        }
        $a[] = '  </tr>';
        $a[] = '</thead>';
        $a[] = '<tbody>';
        // Bucle por los renglones del panal
        foreach ($this->panal as $renglon) {
            $a[] = '  <tr>';
            // Bucle por la estructura
            foreach ($this->estructura as $clave => $e) {
                // Retener los nombres del subíndice y del indicador
                if ($clave == 'subindice_nom_corto') {
                    $subindice = \Base2\UtileriasParaFormatos::caracteres_para_web($renglon[$clave]);
                } elseif ($clave == 'indicador_nombre') {
                    $indicador = \Base2\UtileriasParaFormatos::caracteres_para_web($renglon[$clave]);
                }
                // Mostrar
                if ($clave == 'subindice_nom_corto') {
                    // Es la columna subindice
                    $a[] = sprintf('    <td class="subindice %s">%s</td>', $this->colores[$subindice], $renglon[$clave]);
                } elseif ($clave == 'indicador_nombre') {
                    // Es la columna indicador
                    $a[] = sprintf('    <td class="indicador %s">%s</td>', $this->colores[$subindice], $renglon[$clave]);
                } else {
                    // Es la columna con la región
                    $ruta = sprintf('../indicadores-%s/%s-%s.html', \Base2\UtileriasParaFormatos::caracteres_para_web($clave), $subindice, $indicador);
                    // Vínculo, con o sin tooltip
                    $celda = $renglon[$clave];
                    if ($celda->valor == 'ND') {
                        $mostrar = $celda->formatear();
                    } elseif ($celda->tooltip != '') {
                        $mostrar = sprintf('<a class="vinculo" href="%s" data-toggle="tooltip" title="%s">%s</a>', $ruta, $celda->tooltip, $celda->formatear());
                    } else {
                        $mostrar = sprintf('<a class="vinculo" href="%s">%s</a>', $ruta, $celda->formatear());
                    }
                    // Agregar celda a la tabla
                    if ($celda->valor == 'ND') {
                        $a[] = sprintf('    <td class="nd">%s</td>', $mostrar);
                    } elseif ($this->colores[$subindice] != '') {
                        $a[] = sprintf('    <td class="derecha %s">%s</td>', $this->colores[$subindice], $mostrar);
                    } else {
                        $a[] = sprintf('    <td class="derecha">%s</td>', $mostrar);
                    }
                }
            }
            $a[] = '  </tr>';
        }
        $a[] = '</tbody>';
        $a[] = '</table>';
        // Entregar
        return implode("\n", $a);
    } // php

} // Clase OtrasPHP

?>
