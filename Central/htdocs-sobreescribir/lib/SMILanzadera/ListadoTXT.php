<?php
/**
 * TrcIMPLAN Central - SMILanzadera ListadoTXT
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
 * Clase ListadoTXT
 */
class ListadoTXT {

    public $estructura = array(); // Arreglo de arreglos asociativos con parametros, deben estar presentes enca y ancho
    public $listado    = array(); // Arreglo de arreglos asociativos con resultado de una consulta a la base de datos
    public $panal      = array(); // Arreglo de arreglos asociativos con instancias de celda

    /**
     * Txt
     *
     * @return string Tabla convertida a texto
     */
    public function txt() {
        // Validar
        if (!is_array($this->estructura)) {
            throw new \Exception('Error en ListadoTXT: La estructura es incorrecta.');
        }
        if (count($this->estructura) == 0) {
            throw new \Exception('Error en ListadoTXT: La estructura está vacía.');
        }
        if (!is_array($this->listado)) {
            throw new \Exception('Error en ListadoTXT: El listado es incorrecto.');
        }
        if (!is_array($this->panal)) {
            throw new \Exception('Error en ListadoTXT: El panal es incorrecto.');
        }
        if ((count($this->listado) == 0) && (count($this->panal) == 0)) {
            throw new \Exception('Aviso en ListadoTXT: No hay registros a mostrar.');
        }
        // Acumularemos la salida en este arreglo
        $a = array();
        // Encabezados
        $encabezados = array();
        foreach ($this->estructura as $clave => $parametros) {
            $encabezados[] = UtileriasParaTextos::str_pad_unicode($parametros['enca'], $parametros['ancho'], ' ', STR_PAD_BOTH);
        }
        $a[] = implode(' | ', $encabezados);
        // Linea entre encabezados y renglones
        $separadores = array();
        foreach ($this->estructura as $clave => $parametros) {
            $separadores[] = str_repeat('-', $parametros['ancho']);
        }
        $a[] = implode('-+-', $separadores);
        // Preferir panal sobre listado
        if (count($this->panal) > 0) {
            // Bucle por filas
            foreach ($this->panal as $fila) {
                // Bucle por columnas
                $celdas = array();
                foreach ($this->estructura as $clave => $parametros) {
                    $c = $fila[$clave];
                    // Si es una instancia de celda
                    if (is_object($c) && ($c instanceof Celda)) {
                        // Si en la estructura esta definido la cantidad de decimales
                        if (isset($parametros['cantidad_decimales']) && ($c->decimales === null)) {
                            $c->decimales = $parametros['cantidad_decimales'];
                        }
                        // Si en la estructura esta definido el ancho
                        if (isset($parametros['ancho']) && ($c->tamano_fijo === null)) {
                            $c->tamano_fijo = $parametros['ancho'];
                        }
                        // Formatear la celda convierte su contenido en texto
                        $celdas[] = $c->formatear();
                    } else {
                        // No es instancia de celda
                        $celdas[] = UtileriasParaTextos::str_pad_unicode($c, $parametros['ancho']);
                    }
                }
                $a[] = implode(' | ', $celdas);
            }
        } else {
            // Bucle por filas
            foreach ($this->listado as $fila) {
                // Bucle por columnas
                $celdas = array();
                foreach ($this->estructura as $clave => $parametros) {
                    $celdas[] = UtileriasParaTextos::str_pad_unicode($fila[$clave], $parametros['ancho']);
                }
                $a[] = implode(' | ', $celdas);
            }
        }
        // Entregar
        return implode("\n", $a);
    } // texto

} // Clase ListadoTXT

?>
