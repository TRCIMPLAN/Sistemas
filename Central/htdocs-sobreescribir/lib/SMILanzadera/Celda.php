<?php
/**
 * TrcIMPLAN Central - SMILanzadera Celda
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
 * Clase Celda
 */
class Celda {

    public $valor;              // Valor, dato crudo sin formato
    public $formato;            // Texto cantidad, entero, caracter, decimal, flotante, dinero, fecha, nd, porcentaje, texto
    public $decimales = null;   // Entero, cantidad de decimales
    public $descripciones;      // Arreglo asociativo
    public $tamano_fijo = null; // Entero, cantidad de caracteres
    public $alineacion;         // Texto
    public $tooltip;            // Texto
    public $vinculo;            // URL del vínculo

    /**
     * Constructor
     *
     * @param mixed Valor
     */
    public function __construct($in_valor) {
        // Parametro
        $this->valor = $in_valor;
        // SI el valor es "ND" sera no disponible
        if (($this->valor == 'nd') || ($this->valor == 'ND')) {
            $this->formato    = 'nd';
            $this->alineacion = 'centrado';
        }
    } // constructor

    /**
     * Formatear
     *
     * @return string
     */
    public function formatear() {
        // De acuerdo al formato
        switch ($this->formato) {
            case 'cantidad':
            case 'entero':
                $formateado = \Base2\UtileriasParaFormatos::formato_entero($this->valor);
                break;
            case 'caracter':
                if (array_key_exists($this->valor, $this->descripciones)) {
                    $formateado = $this->descripciones[$this->valor];
                } else {
                    $formateado = 'ND';
                }
                break;
            case 'decimal':
            case 'flotante':
                if ($this->decimales === null) {
                    $formateado = \Base2\UtileriasParaFormatos::formato_flotante($this->valor);
                } else {
                    $formateado = \Base2\UtileriasParaFormatos::formato_flotante($this->valor, $this->decimales);
                }
                break;
            case 'dinero':
                $formateado = \Base2\UtileriasParaFormatos::formato_dinero($this->valor);
                break;
            case 'fecha':
                $formateado = \Base2\UtileriasParaFormatos::formato_fecha($this->valor);
                break;
            case 'nd':
                $formateado = 'ND';
                break;
            case 'porcentaje':
                if ($this->decimales === null) {
                    $formateado = \Base2\UtileriasParaFormatos::formato_porcentaje($this->valor);
                } else {
                    $formateado = \Base2\UtileriasParaFormatos::formato_porcentaje($this->valor, $this->decimales);
                }
                break;
            case 'texto':
            default:
                $formateado = $this->valor;
                if ($this->alineacion == '') {
                    $this->alineacion = 'izquierda';
                }
        }
        // De acuerdo a la alineacion
        if ($this->tamano_fijo > 0) {
            if ($this->formato == 'nd') {
                $relleno = '-';
            } else {
                $relleno = ' ';
            }
            switch ($this->alineacion) {
                case 'izquierda':
                    $alineado = UtileriasParaTextos::str_pad_unicode($formateado, $this->tamano_fijo, $relleno, STR_PAD_RIGHT);
                    break;
                case 'centrado':
                    $alineado = UtileriasParaTextos::str_pad_unicode($formateado, $this->tamano_fijo, $relleno, STR_PAD_BOTH);
                    break;
                case 'derecha':
                    $alineado = UtileriasParaTextos::str_pad_unicode($formateado, $this->tamano_fijo, $relleno, STR_PAD_LEFT);
                    break;
                default:
                    $alineado = $formateado;
            }
        } else {
            $alineado = $formateado;
        }
        // Entregar
        return $alineado;
    } // formatear

    /**
     * Formatear Cantidad
     *
     * @return string Cantidad con formato
     */
    public function formatear_cantidad() {
        $this->formato    = 'cantidad';
        $this->alineacion = 'derecha';
        return $this->formatear();
    } // formatear_cantidad

    /**
     * Formatear Caracter
     *
     * @param  string Arreglo asociativo con las descripciones
     * @return string Decimal con formato
     */
    public function formatear_caracter($in_descripciones=null) {
        if (is_array($in_descripciones)) {
            $this->descripciones = $in_descripciones;
        } else {
            $this->descripciones = array();
        }
        $this->formato    = 'caracter';
        $this->alineacion = 'centrado';
        return $this->formatear();
    } // formatear_caracter

    /**
     * Formatear Decimal
     *
     * @param  integer Cantidad de decimales
     * @return string  Decimal con formato
     */
    public function formatear_decimal($in_decimales=null) {
        $this->formato    = 'decimal';
        $this->decimales  = $in_decimales;
        $this->alineacion = 'derecha';
        return $this->formatear();
    } // formatear_decimal

    /**
     * Formatear Dinero
     *
     * @return string Dinero con formato
     */
    public function formatear_dinero() {
        $this->formato    = 'dinero';
        $this->alineacion = 'derecha';
        return $this->formatear();
    } // formatear_dinero

    /**
     * Formatear Fecha
     *
     * @return string Fecha con formato
     */
    public function formatear_fecha() {
        $this->formato    = 'fecha';
        $this->alineacion = 'centrado';
        return $this->formatear();
    } // formatear_fecha

    /**
     * Formatear Porcentaje
     *
     * @param  integer Cantidad de decimales
     * @return string  Porcentaje con formato
     */
    public function formatear_porcentaje($in_decimales=null) {
        $this->formato    = 'porcentaje';
        $this->decimales  = $in_decimales;
        $this->alineacion = 'derecha';
        return $this->formatear();
    } // formatear_porcentaje

    /**
     * Contar decimales
     *
     * @return integer Cantidad de decimales
     */
    public function contar_decimales() {
        if (($this->formato == 'decimal') || ($this->formato == 'porcentaje')) {
            list($entero, $decimales) = explode('.', rtrim(strval($this->valor), '0'));
            return strlen($decimales);
        } else {
            return null;
        }
    } // contar_decimales

    /**
     * HTML
     *
     * @return string Código HTML
     */
    public function html() {
        // Vínculo
        if ($this->vinculo != '') {
            $pulpa = sprintf('<a href="%s">%s</a>', $this->vinculo, $this->formatear());
        } else {
            $pulpa = $this->formatear();
        }
        // Alineación
        if ($this->alineacion != '') {
            $cascara = sprintf('<td class="%s">%s</td>', $this->alineacion, $pulpa);
        } else {
            $cascara = sprintf('<td>%s</td>', $pulpa);
        }
        // Entregar
        return $cascara;
    } // html

} // Clase Celda

?>
