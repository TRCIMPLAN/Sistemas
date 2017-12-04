#!/usr/bin/env php
<?php
/**
 * TrcIMPLAN Central - Probar Publicaciones Relacionadas
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
$soy = '[Probar Publicaciones Relacionadas]';

// Valores de salida
$EXITO=0;
$E_NOARGS=65;
$E_FATAL=99;

// Cambiarse al directorio donde se encuentra éste archivo
chdir(realpath(dirname(__FILE__)));

// Cargar funciones, éste conteniene el autocargador de clases
require_once('lib/Base/Funciones.php');

// Ayuda
function ayuda() {
    echo "\n";
    echo "Objetivo:\n";
    echo "  Probar la parte Publicaciones Relacionadas que aparece al final de cada página.\n";
    echo "\n";
    echo "Sintaxis:\n";
    echo "  ProbarPublicacionesRelacionadas.php <ID Vínculo>\n";
    echo "\n";
}

// Si se ejecutó sin parámetros
if ($argc == 1) {
    echo "$soy Error: Faltan los parámetros.\n";
    ayuda();
    exit($E_NOARGS);
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

//
// Proceso principal
//

// Cargar la sesión
$sesion = new \Inicio\Sesion('sistema');

// Consultar y mostrar las publicaciones relacionadas
$publicaciones_relacionadas_txt = new \OrgVinculos\PublicacionesRelacionadasTXT($sesion);
try {
    $publicaciones_relacionadas_txt->consultar_vinculo($argv[1]);
    echo $publicaciones_relacionadas_txt->txt()."\n";
} catch (\Exception $e) {
    echo $publicaciones_relacionadas_txt->mensajes."\n";
    echo "$soy ".$e->getMessage()."\n";
    exit($E_FATAL);
}

// Mensaje de término
echo "$soy Programa terminado.\n";
exit($EXITO);

?>
