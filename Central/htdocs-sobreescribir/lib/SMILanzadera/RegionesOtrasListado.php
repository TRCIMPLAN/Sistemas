<?php
/**
 * TrcIMPLAN Central - SMILanzadera RegionesOtrasListado
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

namespace SMILanzadera;

/**
 * Clase RegionesOtrasListado
 *
 * Consultar sólo las regiones NO metropolitanas
 */
class RegionesOtrasListado extends \CatRegiones\Listado {

    /**
     * Validar
     */
    public function validar() {
        // Las otras regiones son mayores a 600
        $this->nivel_desde = 600;
        $this->nivel_hasta = 999;
        // Siempre el estatus es en uso
        $this->estatus = 'A';
        // Ejecutar este mismo método en el padre
        parent::validar();
    } // validar

} // Clase RegionesOtrasListado

?>
