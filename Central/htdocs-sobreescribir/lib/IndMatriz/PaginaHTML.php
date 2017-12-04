<?php
/**
 * TrcIMPLAN Central - IndMatriz PaginaHTML
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
 * Clase PaginaHTML
 */
class PaginaHTML extends \Base\PaginaHTML {

    // protected $sistema;
    // protected $titulo;
    // protected $descripcion;
    // protected $autor;
    // protected $favicon;
    // protected $modelo;
    // protected $menu_principal_logo;
    // protected $modelo_ingreso_logos;
    // protected $modelo_fluido_logos;
    // protected $pie;
    // public $clave;
    // public $menu;
    // public $contenido;
    // public $javascript;
    // protected $sesion;
    // protected $sesion_exitosa;
    // protected $usuario;
    // protected $usuario_nombre;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct('ind_matriz');
    } // constructor

    /**
     * HTML
     *
     * @return string HTML
     */
    public function html() {
        // SOLO SI SE CARGA CON ÉXITO LA SESIÓN
        if ($this->sesion_exitosa) {
            // LISTADO MATRIZ
            $matriz             = new ListadoHTML($this->sesion);
            $matriz->categoria  = $_GET['categoria']; // PUEDE VENIR LA CATEGORIA A FILTRAR POR EL URL
            $matriz->limit      = 0;                  // TODOS SIN PAGINACION
            $this->contenido[]  = $matriz->html();
            $this->javascript[] = $matriz->javascript();
        }
        // EJECUTAR EL PADRE Y ENTREGAR SU RESULTADO
        return parent::html();
    } // html

} // Clase PaginaHTML

?>
