<?php
/**
 * TrcIMPLAN Central - SMILanzadera IndicadorMapasRegionListado
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
 * Clase IndicadorMapasRegionListado
 *
 * Consultar los mapas del indicador en una región
 * Es obligatorio que se definan las propiedades indicador y region
 */
class IndicadorMapasRegionListado extends \IndIndicadoresMapas\Listado {

    // protected $sesion;       // Instancia con la sesión
    // public $consultado;      // Bandera
    // public $listado;         // Arreglo donde el método consultar deja la consulta
    // public $panal;           // Arreglo de arreglos con instancias de Celda que formatear armará
    // public $indicador;       // Filtro con ID del indicador
    // public $region;          // Filtro con ID de la región
    // public $estatus;         // Filtro con caracter, 'A' es EN USO, 'B' es ELIMINADO

    /**
     * Validar
     */
    public function validar() {
        // Validar que esté definido el indicador
        if (!\Base2\UtileriasParaValidar::validar_entero($this->indicador)) {
            throw new \Base2\ListadoExceptionValidacion("Error en IndicadorDatosRegionListado, validar: No ha definido el indicador.");
        }
        // Validar que esté definida la región
        if (!\Base2\UtileriasParaValidar::validar_entero($this->region)) {
            throw new \Base2\ListadoExceptionValidacion("Error en IndicadorDatosRegionListado, validar: No ha definido la región.");
        }
        // Siempre el estatus es EN USO
        $this->estatus = 'A';
        // Ejecutar padre
        parent::validar();
    } // validar

} // Clase IndicadorMapasRegionListado

?>
