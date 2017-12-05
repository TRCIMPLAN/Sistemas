<?php
/**
 * TrcIMPLAN Central - Categorias Listado CSV
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

namespace IndCategorias;

/**
 * Clase ListadoCSV
 */
class ListadoCSV extends Listado {

    protected $estructura;

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        // DEFINIR ESTRUCTURA
        $this->estructura = array(
            'nombre' => array(
                'enca'  => 'Categoría'),
            'cantidad' => array(
                'enca' => 'Cantidad'));
        // EJECUTAR EL CONSTRUCTOR DEL PADRE
        parent::__construct($in_sesion);
    } // constructor

    /**
     * CSV
     *
     * Esta clase puede causar una excepcion si falla la consulta
     *
     * @return string CSV
     */
    public function csv() {
        // CONSULTAR
        $this->consultar(); // PUEDE CAUSAR UNA EXCEPCION
        // INICIAR LISTADO CSV
        $listado_csv             = new \Base2\ListadoCSV();
        $listado_csv->estructura = $this->estructura;
        $listado_csv->listado    = $this->listado;
        // ENTREGAR
        return $listado_csv->csv();
    } // csv

} // Clase ListadoCSV

?>
