#!/usr/bin/env php
<?php
/**
 * Central - Alimentar Organizador
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
$soy = '[Alimentar Organizador]';

// Valores de salida
$EXITO=0;
$E_FATAL=99;

// Ayuda
function ayuda() {
    echo "\n";
    echo "Objetivo:\n";
    echo "  Alimentar los vínculos y los elementos del organizador.\n";
    echo "  De la BD consultará las ramas con las rutas que contienen las publicaciones.\n";
    echo "  Vaciará e insertará registros en la tabla de vínculos.\n";
    echo "  Vaciará e insertará registros en la tabla de elementos.\n";
    echo "\n";
    echo "Sintaxis:\n";
    echo "  AlimentarOrganizador.php\n";
    echo "\n";
}

// Si el parámetro es para mostrar la ayuda
if (($argc == 2) && (($argv[1] == '-h') || ($argv[1] == '--help'))) {
    ayuda();
    exit($EXITO);
}

// Cambiarse al directorio donde se encuentra éste archivo
chdir(realpath(dirname(__FILE__)));

// De forma exclusiva necesito mi propio cargador de clases y funciones
require_once('AlimentarOrganizadorFunciones.php');

// Cargar sesión
$sesion = new \Inicio\Sesion('sistema');

// Vaciar la tabla de elementos y la tabla de vínculos
$eliminador_elementos = new \OrgElementos\Eliminador($sesion);
$eliminador_vinculos  = new \OrgVinculos\Eliminador($sesion);
try {
    echo "$soy Eliminando elementos...\n";
    echo $eliminador_elementos->eliminar()."\n";
    echo "$soy Eliminando vínculos...\n";
    echo $eliminador_vinculos->eliminar()."\n";
} catch (\Exception $e) {
    echo "$soy ".$e->getMessage()."\n";
    exit($E_FATAL);
}
unset($eliminador_elementos);
unset($eliminador_vinculos);

// Recolectar las publicaciones y agregar los vínculos
$recolector = new \OrgVinculos\Recolector($sesion);
try {
    echo "$soy Recolectando publicaciones...\n";
    echo $recolector->recolectar()."\n";
    echo "$soy Agregando vínculos...\n";
    echo $recolector->agregar()."\n";
} catch (\Exception $e) {
    echo "$soy ".$e->getMessage()."\n";
    exit($E_FATAL);
}
unset($recolector);

// Mensaje de término
echo "$soy Terminó\n";
exit($EXITO);

?>
