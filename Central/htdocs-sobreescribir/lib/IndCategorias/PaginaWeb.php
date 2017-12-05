<?php
/**
 * TrcIMPLAN Central - Categorias PaginaWeb
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
 * Clase PaginaWeb
 */
class PaginaWeb extends \Base2\PaginaWeb {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct('ind_categorias');
    } // constructor

    /**
     * HTML
     *
     * @return string HTML
     */
    public function html() {
        // SOLO SI SE CARGA CON ÉXITO LA SESIÓN
        if ($this->sesion_exitosa) {
            // LISTADO CATEGORIAS
            $categorias         = new ListadoWeb($this->sesion);
            $categorias->limit  = 0; // TODOS SIN PAGINACION
            $this->contenido[]  = $categorias->html();
            $this->javascript[] = $categorias->javascript();
        }
        // EJECUTAR EL PADRE Y ENTREGAR SU RESULTADO
        return parent::html();
    } // html

} // Clase PaginaWeb

?>
