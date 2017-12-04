<?php
/**
 * Central - Alimentar Organizador Funciones
 *
 * Copyright (C) 2017 Guillermo Valdes Lozano guillermo@movimientolibre.com
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

// Caracteres UTF-8
mb_internal_encoding('utf-8');

//
// Autocargador de clases para AlimentarOrganizador.php
// Si existe el archivo en lib/ lo carga, si no, lo carga en lib/OrgSitioWeb/lib/
//
spl_autoload_register(
    /**
     * Auto-cargador de Clases
     *
     * @param string Creación de la instancia
     */
    function ($className) {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
        // Si existe el archivo en lib/ lo carga, si no, lo carga en lib/OrgSitioWeb/
        if (file_exists('lib/'.$fileName)) {
            // echo "    LOAD lib/$fileName \n";
            require 'lib/'.$fileName;
        } else {
            // echo "    LOAD lib/OrgSitioWeb/lib/$fileName \n";
            require 'lib/OrgSitioWeb/lib/'.$fileName;
        }
    } // auto-cargador de clases
);

function validar_entero($entero) {
    if (is_string($entero)) {
        if (preg_match('/^[0-9]+$/', $entero)) {
            return true;
        } else {
            return false;
        }
    } elseif (is_int($entero)) {
        return ($entero >= 0);
    } else {
        return false;
    }
} // validar_entero

function arreglo_sin_valores_repetidos($in_arreglo) {
    if (!is_array($in_arreglo) || (count($in_arreglo) == 0)) {
        return array();
    }
    $arreglo = array();
    foreach ($in_arreglo as $a) {
        if (!in_array($a, $arreglo)) {
            $arreglo[] = $a;
        }
    }
    return $arreglo;
} // arreglo_sin_valores_repetidos

function sql_entero($dato) {
    if (is_string($dato)) {
        if (trim($dato) == '') {
            return 'NULL';
        } elseif (trim($dato) == '0') {
            return '0';
        } else {
            return $dato;
        }
    } elseif (is_int($dato)) {
        if ($dato == 0) {
            return 0;
        } else {
            return $dato;
        }
    } else {
        return intval($dato);
    }
} // sql_entero

function sql_texto($dato) {
    if (trim($dato) == '') {
        return 'NULL';
    } else {
        return "'".pg_escape_string(trim($dato))."'";
    }
} // sql_texto

function sql_tiempo($dato) {
    if (is_string($dato)) {
        if ($dato == '') {
            return 'NULL';
        } elseif (preg_match('/^[0-9]+$/', $dato)) {
            return "'".date('Y-m-d H:i:s', $dato)."'";
        } else {
            return "'$dato'";
        }
    } elseif (is_integer($dato)) {
        return "'".date('Y-m-d H:i:s', $dato)."'";
    } else {
        return 'NULL';
    }
} // sql_tiempo

function validar_fecha_hora($fecha_hora) {
    // VALIDA
    if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2} \d{1,2}:\d{1,2}:\d{1,2}$/', $fecha_hora)) {
        return true; // AAAA-MM-DD HH:MM:SS
    } elseif (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}T\d{1,2}:\d{1,2}:\d{1,2}$/', $fecha_hora)) {
        return true; // AAAA-MM-DDTHH:MM:SS
    } elseif (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2} \d{1,2}:\d{1,2}$/', $fecha_hora)) {
        return true; // AAAA-MM-DD HH:MM
    } elseif (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}T\d{1,2}:\d{1,2}$/', $fecha_hora)) {
        return true; // AAAA-MM-DDTHH:MM
    } elseif (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha_hora)) {
        return true; // AAAA-MM-DD
    } else {
        return false;
    }
} // validar_fecha_hora

function validar_frase($frase) {
    if (trim($frase) == '') {
        return false;
    } elseif (preg_match('/^[a-zA-Z0-9áÁéÉíÍóÓúÚüÜñÑ#&%$@¿?()<>{}|="“” .,;:\/\[\]*+_-]+$/', $frase)) {
        return true;
    } else {
        return false;
    }
} // validar_frase

function validar_nombre($nombre) {
    if (trim($nombre) == '') {
        return false;
    } elseif (preg_match('/^[a-zA-Z0-9áÁéÉíÍóÓúÚüÜñÑ() ._-]+$/', $nombre)) {
        return true;
    } else {
        return false;
    }
} // validar_nombre

function validar_notas($notas) {
    if (trim($notas) == '') {
        return false;
    } elseif (preg_match('/^[a-zA-Z0-9áÁéÉíÍóÓúÚüÜñÑ#&%$@¿?()<>{}|="“” .,:;\'\/\n\r\[\]\\\\_+*-]+$/', $notas)) {
        return true;
    } else {
        return false;
    }
} // validar_notas

?>
