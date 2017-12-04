#!/usr/bin/env php
<?php
/**
 * TrcIMPLAN Central - Crear Publicaciones Relacionadas
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
$soy = '[Crear Publicaciones Relacionadas]';

// Valores de salida
$EXITO=0;
$E_FATAL=99;

// Cambiarse al directorio donde se encuentra éste archivo
chdir(realpath(dirname(__FILE__)));

// Cargar funciones, éste conteniene el autocargador de clases
require_once('lib/Base/Funciones.php');

// Ayuda
function ayuda() {
    echo "\n";
    echo "Objetivo:\n";
    echo "  Crear los archivos con las Publicaciones Relacionadas.\n";
    echo "  Ejecutará \\OrgVinculos\\ImprentaPublicacionesRelacionadas.\n";
    echo "\n";
    echo "Sintaxis:\n";
    echo "  CrearPublicacionesRelacionadas.php\n";
    echo "\n";
}

// Si el parámetro es para mostrar la ayuda
if (($argc == 2) && (($argv[1] == '-h') || ($argv[1] == '--help'))) {
    ayuda();
    exit($EXITO);
}

// Cargar Sesión
$sesion = new \Inicio\Sesion('sistema');

// En este arreglo están las rutas a las clases Imprenta
$clases = array(
    '\OrgVinculos\ImprentaPublicacionesRelacionadas');

// Imprimir
echo "$soy Inicia\n";
try {
    foreach ($clases as $clase) {
        $impresor = new $clase($sesion);
        echo $impresor->imprimir()."\n";
    }
} catch (\Exception $e) {
    echo implode("\n", $impresor->mensajes)."\n";
    echo "$soy ".$e->getMessage()."\n";
    exit($E_FATAL);
}

// Mensaje de término
echo "$soy Terminó\n";
exit($EXITO);

?>
