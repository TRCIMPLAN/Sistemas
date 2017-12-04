<?php
/**
 * TrcIMPLAN Central - OrgElementos Eliminador
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

namespace OrgElementos;

/**
 * Clase Eliminador
 */
class Eliminador {

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // constructor

    /**
     * Eliminar
     *
     * @return string Mensaje
     */
    public function eliminar() {
        // Que tenga permiso para eliminar
        if (!$this->sesion->puede_eliminar('org_elementos')) {
            throw new \Exception('Aviso: No tiene permiso para eliminar elementos.');
        }
        // Eliminar
        $base_datos = new \Base\BaseDatosMotor();
        try {
            $base_datos->comando("DELETE FROM org_elementos");
            $base_datos->comando("ALTER SEQUENCE org_elementos_id_seq RESTART");
        } catch (\Exception $e) {
            throw new \Base\BaseDatosExceptionSQLError($this->sesion, 'Error: Al eliminar los registros de los elementos. ', $e->getMessage());
        }
        // Entregar mensaje
        return "  Se eliminaron todos los registros de los elementos.";
    } // eliminar

} // Clase Eliminador

?>
