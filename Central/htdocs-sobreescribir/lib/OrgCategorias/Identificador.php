<?php
/**
 * TrcIMPLAN Central - OrgCategorias Identificador
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

namespace OrgCategorias;

/**
 * Clase Identificador
 */
class Identificador {

    protected $categorias_todas;

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // constructor

    /**
     * Consultar todos los autores
     */
    protected function consultar_todos() {
        // Inicializar propiedad
        $this->categorias_todas = array();
        // Consultar
        $base_datos = new \Base\BaseDatosMotor();
        try {
            $consulta = $base_datos->comando("SELECT id, nombre FROM org_categorias WHERE estatus = 'A' ORDER BY nombre ASC");
        } catch (Exception $e) {
            throw new \Base\BaseDatosExceptionSQLError($this->sesion, 'Error en Identificador: Al consultar las categorías.', $e->getMessage());
        }
        // Si la cantidad de registros es cero
        if ($consulta->cantidad_registros() == 0) {
            throw new \Exception('Error en Identificador: No hay registros en categorías.');
        }
        // Bucle para cargar la propiedad con los nombres y sus IDs
        foreach ($consulta->obtener_todos_los_registros() as $registro) {
            $this->categorias_todas[$registro['nombre']] = $registro['id'];
        }
    } // consultar_todos

    /**
     * Identificar
     *
     * @param  array Arreglo con los nombres de las categorias a identificar
     * @return array Arreglo con los ID de las categorías identificadas
     */
    public function identificar($nombres) {
        // Si no se han cargado todas las categorías
        if (!is_array($this->categorias_todas)) {
            $this->consultar_todos();
        }
        // Acumularemos los IDs en este arreglo
        $ids = array();
        // Si se entregan los nombres como un arreglo
        if (is_array($nombres) && (count($nombres) > 0)) {
            // Bucle por los nombres
            foreach ($nombres as $n) {
                $nombre = trim($n);
                // Si el nombre es una categoría registrada
                if (isset($this->categorias_todas[$nombre])) {
                    $id = $this->categorias_todas[$nombre];
                    // Evitar duplicados
                    if (!in_array($id, $ids)) {
                        $ids[] = $id;
                    }
                }
            }
        } elseif (is_string($nombres) && ($nombres != '')) {
            // Se entregó una cadena de texto, puede tener varios nombres separados por comas
            $arreglo = explode(',', $nombres);
            // Bucle por los nombres
            foreach ($arreglo as $n) {
                $nombre = trim($n);
                // Si el nombre es una categoría registrada
                if (isset($this->categorias_todas[$nombre])) {
                    $id = $this->categorias_todas[$nombre];
                    // Evitar duplicados
                    if (!in_array($id, $ids)) {
                        $ids[] = $id;
                    }
                }
            }
        }
        // Si NO se identificó a ninguna categoría
        if (count($ids) == 0) {
            $ids[] = '1'; // Se le da una sola categoría: SIN CATEGORÍA
        }
        // Entregar
        return $ids;
    } // identificar

} // Clase Identificador

?>
