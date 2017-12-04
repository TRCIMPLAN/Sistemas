<?php
/**
 * TrcIMPLAN Central - OrgVinculos Eliminador
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

namespace OrgVinculos;

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
        if (!$this->sesion->puede_eliminar('org_vinculos')) {
            throw new \Exception('Aviso: No tiene permiso para eliminar vínculos.');
        }
        // Eliminar
        $base_datos = new \Base\BaseDatosMotor();
        try {
            $base_datos->comando("DELETE FROM org_vinculos");
            $base_datos->comando("ALTER SEQUENCE org_vinculos_id_seq RESTART");
        } catch (\Exception $e) {
            throw new \Base\BaseDatosExceptionSQLError($this->sesion, 'Error en Eliminador: Al eliminar los registros de los vínculos. ', $e->getMessage());
        }
        // Entregar mensaje
        return "  Se eliminaron todos los registros de los vínculos.";
    } // eliminar

} // Clase Eliminador

?>
