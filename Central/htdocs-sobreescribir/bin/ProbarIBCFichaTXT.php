#!/usr/bin/env php
<?php
/**
 * TrcIMPLAN Central - Probar IBC Ficha TXT
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

// Soy
$soy = '[Probar IBC Ficha TXT]';

// Valores de salida
$EXITO=0;
$E_NOARGS=65;
$E_FATAL=99;

// Cambiarse al directorio donde se encuentra éste archivo
chdir(realpath(dirname(__FILE__)));

// Cargar autocargador de clases
require_once('lib/Base2/AutocargadorClases.php');

// Ayuda
function ayuda() {
    echo "\n";
    echo "Objetivo:\n";
    echo "  Mostrará los datos usados para crear un publicación de un conglomerado del IBC.\n";
    echo "\n";
    echo "Sintaxis:\n";
    echo "  ProbarIBCFichaTXT.php <ID Conglomerado>\n";
    echo "\n";
}

// Si el parámetro es para mostrar la ayuda
if (($argc == 2) && (($argv[1] == '-h') || ($argv[1] == '--help'))) {
    ayuda();
    exit($EXITO);
}
// Si faltan parámetros
if ($argc < 2) {
    echo "$soy Error: Faltan los parámetros.\n";
    ayuda();
    exit($E_NOARGS);
}

// Cargar la sesión
$sesion = new \Inicio\Sesion('sistema');

// Proceso principal
$ficha_txt = new \IbcLanzadera\FichaTXT($sesion);
try {
    echo "$soy Elaborando ficha...\n";
    $ficha_txt->consultar($argv[1]);
    echo $ficha_txt->texto()."\n";
} catch (\Exception $e) {
    echo "$soy ".$e->getMessage()."\n";
    exit($E_FATAL);
}

// Mensaje de término
echo "$soy Programa terminado.\n";
exit($EXITO);

?>
