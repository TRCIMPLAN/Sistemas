<?php
/**
 * TrcIMPLAN Central - IndMatriz PaginaCSV
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

namespace IndMatriz;

/**
 * Clase PaginaCSV
 */
class PaginaCSV extends \Base2\PaginaCSV {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct('ind_matriz');
    } // constructor

    /**
     * CSV
     *
     * @return string CSV
     */
    public function csv() {
        // SOLO SI SE CARGA CON ÉXITO LA SESIÓN
        if ($this->sesion_exitosa) {
            if ($_GET['csv'] == 'descargar') {
                $listado         = new ListadoCSV($this->sesion);
                $this->contenido = $listado->csv();
            }
        }
        // EJECUTAR EL PADRE Y ENTREGAR SU RESULTADO
        return parent::csv();
    } // csv

} // Clase PaginaCSV

?>
