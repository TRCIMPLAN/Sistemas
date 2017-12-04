<?php
/**
 * TrcIMPLAN Central - IBCLanzadera Dato
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

namespace IBCLanzadera;

/**
 * Clase Dato
 *
 * Confina un dato (valor y formato) y la da formato de salida
 */
class Dato {

    protected $valor;
    protected $formato;
    protected $fecha;

    /**
     * Obtener valor
     *
     * @return mixed
     */
    public function obtener_valor() {
        return $this->valor;
    } // obtener_valor

    /**
     * Obtener formato
     *
     * @return string
     */
    public function obtener_formato() {
        return $this->formato;
    } // obtener_formato

    /**
     * Obtener fecha
     *
     * @return string
     */
    public function obtener_fecha() {
        return $this->fecha;
    } // obtener_fecha

    /**
     * Agregar cantidad
     */
    public function agregar_cantidad($in_valor, $in_fecha) {
        $this->formato = 'entero';
        $this->valor   = $in_valor;
        $this->fecha   = $in_fecha;
    } // agregar_cantidad

    /**
     * Agregar decimal
     */
    public function agregar_decimal($in_valor, $in_fecha) {
        $this->formato = 'flotante';
        $this->valor   = $in_valor;
        $this->fecha   = $in_fecha;
    } // agregar_decimal

    /**
     * Agregar dinero
     */
    public function agregar_dinero($in_valor, $in_fecha) {
        $this->formato = 'dinero';
        $this->valor   = $in_valor;
        $this->fecha   = $in_fecha;
    } // agregar_dinero

    /**
     * Agregar porcentaje
     */
    public function agregar_porcentaje($in_valor, $in_fecha) {
        $this->formato = 'porcentaje';
        $this->valor   = $in_valor;
        $this->fecha   = $in_fecha;
    } // agregar_porcentaje

    /**
     * Agregar caracter
     */
    public function agregar_caracter($in_valor, $in_fecha) {
        $this->formato = 'caracter';
        $this->valor   = $in_valor;
        $this->fecha   = $in_fecha;
    } // agregar_caracter

    /**
     * Agregar texto
     */
    public function agregar_texto($in_valor, $in_fecha) {
        $this->formato = 'texto';
        $this->valor   = $in_valor;
        $this->fecha   = $in_fecha;
    } // agregar_texto

    /**
     * Texto
     */
    public function texto() {
        switch ($this->formato) {
            case 'entero':
                return number_format($this->valor, 0, ".", ",");
                break;
            case 'flotante':
                return number_format($this->valor, 4, ".", ",");
                break;
            case 'dinero':
                return '$'.number_format($this->valor, 2, ".", ",");
                break;
            case 'porcentaje':
                return number_format($this->valor, 2, ".", ",")." %";
                break;
            case 'caracter':
                return \DagComponentes\Registro::$caracter_descripciones[$this->valor];
                break;
            case 'texto':
                return $this->valor;
                break;
            default:
                return '';
        }
    } // texto

} // Clase Dato

?>
