<?php
/**
 * TrcIMPLAN Central - SMILanzadera UtileriasParaTextos
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
 * Clase abstracta UtileriasParaTextos
 */
abstract class UtileriasParaTextos {

    /**
     * Str Pad Unicode
     *
     * Rellenar con espacios, funciona con Unicode.
     * Tomado de https://stackoverflow.com/questions/14773072/php-str-pad-unicode-issue
     *
     * @param  string  Texto a mostrar
     * @param  integer Cantidad de caracteres
     * @param  string  Texto para rellenar espacio
     * @return mixed   Constante de dirección: STR_PAD_LEFT, STR_PAD_BOTH o STR_PAD_RIGHT
     */
    public static function str_pad_unicode($str, $pad_len, $pad_str=' ', $dir=STR_PAD_RIGHT) {
        $str_len     = mb_strlen($str);
        $pad_str_len = mb_strlen($pad_str);
        if (!$str_len && ($dir == STR_PAD_RIGHT || $dir == STR_PAD_LEFT)) {
            $str_len = 1; // @debug
        }
        if (!$pad_len || !$pad_str_len) {
            return $str;
        }
        if ($pad_len <= $str_len) {
            return mb_substr($str, 0, $pad_len);
        }
        $result = null;
        if ($dir == STR_PAD_BOTH) {
            $length = ($pad_len - $str_len) / 2;
            $repeat = ceil($length / $pad_str_len);
            $result = mb_substr(str_repeat($pad_str, $repeat), 0, floor($length)) . $str . mb_substr(str_repeat($pad_str, $repeat), 0, ceil($length));
        } else {
            $repeat = ceil($str_len - $pad_str_len + $pad_len);
            if ($dir == STR_PAD_RIGHT) {
                $result = $str . str_repeat($pad_str, $repeat);
                $result = mb_substr($result, 0, $pad_len);
            } else if ($dir == STR_PAD_LEFT) {
                $result = str_repeat($pad_str, $repeat);
                $result = mb_substr($result, 0, $pad_len - (($str_len - $pad_str_len) + $pad_str_len)) . $str;
            }
        }
        return $result;
    } // str_pad_unicode

} // Clase abstracta UtileriasParaTextos

?>
