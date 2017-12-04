<?php
/**
 * TrcIMPLAN Central - Categorías Listado Texto
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
 * Clase ListadoTexto
 */
class ListadoTexto extends Listado {

    // public $listado;
    // public $panal;
    // public $cantidad_registros;
    // public $limit;
    // protected $offset;
    // protected $sesion;
    // public $categoria;
    // public $estructura;
    // public $tooltips;
    // public $formatos;
    // static public $param_categoria;

    /**
     * Texto
     *
     * @return string Texto
     */
    public function texto() {
        // CONSULTAR
        try {
            $this->consultar();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        // LISTADO TEXTO
        $listado_texto             = new \Base\ListadoTexto();
        $listado_texto->estructura = array(
            'nombre'   => array(
                'enca'  => 'Categoría',
                'ancho' => 24),
            'cantidad' => array(
                'enca'  => 'Cantidad',
                'ancho' => 12));
        $listado_texto->panal      = $this->panal;
        // ENTREGAR
        return $listado_texto->texto();
    } // texto

} // Clase ListadoTexto

?>
