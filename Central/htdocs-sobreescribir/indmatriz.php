<?php
/**
 * TrcIMPLAN Central - Página Indicadores Matriz
 *
 * Copyright (C) 2016 Guillermo Valdés Lozano
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

require_once('lib/Base/AutocargadorClases.php');

// Si se solicita la descarga de archivo csv
if ($_GET['csv'] != '') {
    $pagina_csv = new \IndMatriz\PaginaCSV();
    echo $pagina_csv->csv();
} else {
    // Mostrar la página HTML
    $pagina_html = new \IndMatriz\PaginaWeb();
    echo $pagina_html->html();
}

?>
