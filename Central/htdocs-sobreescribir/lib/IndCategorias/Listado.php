<?php
/**
 * TrcIMPLAN Central - Categorias Listado
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
 * Clase Listado
 */
class Listado extends \Base2\Listado {

    /**
     * Validar
     */
    public function validar() {
        // VALIDAR PERMISO
        if (!$this->sesion->puede_ver('ind_categorias')) {
            throw new \Exception('Aviso: No tiene permiso para ver las categorias.');
        }
        // EJECUTAR METODO DEL PADRE
        parent::validar();
    } // validar

    /**
     * Encabezado
     *
     * @return string Texto del encabezado
     */
    public function encabezado() {
        return "Categorías";
    } // encabezado

    /**
     * Consultar
     */
    public function consultar() {
        // VALIDAR
        $this->validar(); // PUEDE CAUSAR EXCEPCION
        // INICIAR LAS PROPIEDADES
        $this->listado = array();
        $this->panal   = array();
        // CONSULTAR INDICADORES DE ESE SUBINDICE
        $indicadores          = new \IndIndicadores\Listado($this->sesion);
        $indicadores->estatus = 'A';
        $indicadores->consultar(); // PUEDE CAUSAR UNA EXCEPCION
        // EN ESTE ARREGLO ACUMULAREMOS LAS CATEGORIAS
        $categorias = array();
        $cantidades = array();
        // BUCLE INDICADORES
        foreach ($indicadores->listado as $a) {
            // SI ESTA VACIO SE SALTA
            if ($a['categorias'] == '') {
                continue;
            }
            // EL CAMPO DE CATEGORIAS PUEDE TENER MAS DE UNA SEPARADA POR COMAS
            foreach (explode(',', $a['categorias']) as $c) {
                $cat = trim($c);
                if (!in_array($cat, $categorias)) {
                    $categorias[]     = $cat;
                    $cantidades[$cat] = 1;
                } else {
                    $cantidades[$cat]++;
                }
            }
        }
        // TRONAR SI NO HUBO CATEGORIAS
        if (count($categorias) == 0) {
            throw new \Base2\ListadoExceptionVacio("Error en Listado de Categorías: Ningún indicador tiene categorías.");
        }
        // ORDEN ALFABETICO
        sort($categorias);
        // CARGAR PROPIEDAD PANAL
        foreach ($categorias as $cat) {
            $nombre   = new \Base2\Celda($cat);
            $cantidad = new \Base2\Celda($cantidades[$cat]);
            $cantidad->formatear_cantidad();
            $this->panal[] = array(
                'nombre'   => $nombre,
                'cantidad' => $cantidad);
        }
        // DEFINIR LAS OTRAS PROPIEDADES
        $this->definir_listado_desde_panal();
        $this->cantidad_registros = count($this->panal);
    } // consultar

} // Clase Listado

?>
