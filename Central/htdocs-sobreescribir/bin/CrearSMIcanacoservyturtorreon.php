#!/usr/bin/env php
<?php
/**
 * TrcIMPLAN Central - Crear SMI CANACO
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
$soy = '[Crear SMI CANACO]';

// Valores de salida
$EXITO=0;
$E_FATAL=99;

// Cambiarse al directorio donde se encuentra éste archivo
chdir(realpath(dirname(__FILE__)));

// Cargar autocargador de clases
require_once('lib/Base2/AutocargadorClases.php');

// Ayuda
function ayuda() {
    echo "\n";
    echo "Objetivo:\n";
    echo "  Crear los archivos con las publicaciones de los Indicadores SMI.\n";
    echo "  Ejecutará \\SmiLanzadera\\ImprentaIndicadores.\n";
    echo "\n";
    echo "Sintaxis:\n";
    echo "  CrearSMIcanacoservyturtorreon.php\n";
    echo "\n";
}

// Si el parámetro es para mostrar la ayuda
if (($argc == 2) && (($argv[1] == '-h') || ($argv[1] == '--help'))) {
    ayuda();
    exit($EXITO);
}

// Cargar Sesión
$sesion = new \Inicio\Sesion('sistema');

// Constantes para CANACO
$sitio_web_directorio = 'canacoservyturtorreon';
$categorias = array('Delincuencia', 'Empresas', 'Mercados', 'Seguridad');
$fuentes    = array('IMCO', 'IMPLAN', 'INEGI', 'Secretariado Ejecutivo del Sistema Nacional de Seguridad Pública');
$regiones   = array('Torreón', 'La Laguna');

// Mensaje de inicio
echo "$soy Inicia\n";

// Mostrar las constantes
echo "$soy Constantes:\n";
echo "  Directorio:            ", $sitio_web_directorio, "\n";
echo "  Filtro por categorías: ", implode(', ', $categorias), "\n";
echo "  Filtro por fuentes:    ", implode(', ', $fuentes), "\n";
echo "  Filtro por regiones:   ", implode(', ', $regiones), "\n";

// Definir filtros
$filtro_categorias = new \SMILanzadera\FiltroCategorias($sesion);
$filtro_fuentes    = new \SMILanzadera\FiltroFuentes($sesion);
$filtro_regiones   = new \SMILanzadera\FiltroRegiones($sesion);
try {
    $filtro_categorias->definir_filtro($categorias);
    $filtro_fuentes->definir_filtro($fuentes);
    $filtro_regiones->definir_filtro($regiones);
} catch (\Exception $e) {
    echo $e->getMessage()."\n";
    exit($E_FATAL);
}

// Ejecutar SMI indicadores
$publicador = new \SMILanzadera\PublicadorSMI($sesion);
$publicador->definir_sitio_web_directorio($sitio_web_directorio);
$publicador->definir_filtro_categorias($filtro_categorias);
$publicador->definir_filtro_fuentes($filtro_fuentes);
$publicador->definir_filtro_regiones($filtro_regiones);
try {
    $publicador->publicar();
} catch (\Exception $e) {
    echo implode("\n", $publicador->mensajes)."\n";
    echo $e->getMessage()."\n";
    exit($E_FATAL);
}

// Ejecutar SMI por categorías
$publicador = new \SMILanzaderaPorCategorias\PublicadorSMI($sesion);
$publicador->definir_sitio_web_directorio($sitio_web_directorio);
$publicador->definir_filtro_categorias($filtro_categorias);
$publicador->definir_filtro_fuentes($filtro_fuentes);
$publicador->definir_filtro_regiones($filtro_regiones);
try {
    $publicador->publicar();
} catch (\Exception $e) {
    echo implode("\n", $publicador->mensajes)."\n";
    echo $e->getMessage()."\n";
    exit($E_FATAL);
}

// Ejecutar SMI por regiones
//~ $publicador = new \SMILanzaderaPorRegiones\PublicadorSMI($sesion);
//~ $publicador->definir_sitio_web_directorio($sitio_web_directorio);
//~ $publicador->definir_filtro_categorias($filtro_categorias);
//~ $publicador->definir_filtro_fuentes($filtro_fuentes);
//~ $publicador->definir_filtro_regiones($filtro_regiones);
//~ try {
    //~ $publicador->publicar();
//~ } catch (\Exception $e) {
    //~ echo implode("\n", $publicador->mensajes)."\n";
    //~ echo $e->getMessage()."\n";
    //~ exit($E_FATAL);
//~ }

// Mensaje de término
echo "$soy Terminó\n";
exit($EXITO);

?>
