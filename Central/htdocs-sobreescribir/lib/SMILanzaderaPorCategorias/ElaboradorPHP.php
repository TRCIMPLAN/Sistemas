<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorCategorias ElaboradorPHP
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

namespace SMILanzaderaPorCategorias;

/**
 * Clase abstracta ElaboradorPHP
 *
 * Para crear la Imprenta, ImprentaCSV e ImprentaJSONs
 */
abstract class ElaboradorPHP {

    protected $espacio;    // Texto con el namespace
    protected $clase;      // Texto con el nombre de la clase
    protected $directorio; // Texto con el nombre del directorio en la raiz del sitio web

    /**
     * Validar
     */
    protected function validar() {
        // Definir propiedades
        $this->espacio    = 'SMICategorias';
        $this->clase      = 'Imprenta';
        $this->directorio = 'indicadores-categorias';
    } // validar

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo
     */
    public function ruta() {
        // Validar
        $this->validar();
        // Entregar
        return sprintf('lib/%s/%s.php', $this->espacio, $this->clase);
    } // ruta

    abstract function php();

} // Clase abstracta ElaboradorPHP

?>
