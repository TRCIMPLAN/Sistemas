<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorCategorias MatrizTXT
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
 * Clase MatrizTXT
 */
class MatrizTXT extends Matriz {

    // public $consultado;
    // protected $sesion;
    // public $listado;
    // public $panal;
    // public $cantidad_registros;
    // public $limit;
    // public $offset;
    // public $estructura;
    // public $categoria;
    // public $region;
    // protected $filtro_categorias;
    // protected $filtro_fuentes;
    // protected $filtro_regiones;

    /**
     * TXT
     *
     * @return string Texto
     */
    public function txt() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en MatrizTXT: No se ha consultado.");
        }
        // Acumular generalidades
        $a   = array();
        $a[] = 'Matriz';
        $a[] = sprintf('  Categoría: %s', $this->categoria);
        $a[] = sprintf('  Región:    %s', $this->region);
        $a[] = '';
        // Acumular tabla
        $tabla             = new \SMILanzadera\ListadoTXT();
        $tabla->estructura = $this->estructura;
        $tabla->panal      = $this->panal;
        $a[]               = $tabla->txt();
        // Entregar
        return "\n".implode("\n", $a)."\n";
    } // txt

} // Clase MatrizTXT

?>
