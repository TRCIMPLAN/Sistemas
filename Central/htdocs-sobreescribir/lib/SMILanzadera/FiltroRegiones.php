<?php
/**
 * TrcIMPLAN Central - SMILanzadera FiltroRegiones
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
 * Clase FiltroRegiones
 *
 * En esta clase se encapsula el procedimiento de definir y filtrar por regiones.
 * Es sensible a las mayúsculas y minúsculas.
 * Si no se ejecuta definir_filtro o tiene un parámetro nulo, no filtrará y permitirá cualquier valor.
 * Ejemplo:
 *     $filtro = new FiltroRegiones($sesion);
 *     $filtro->definir_filtro("Torreón, La Laguna"); // También puede recibir un arreglo de textos
 *     if ($filtro->filtrar("Torreón, Gómez Palacio")) { echo("Sí contiene una región permitida"); }
 */
class FiltroRegiones extends Filtro {

    // protected $filtro;
    // protected $sesion;
    // protected $definido;

    /**
     * Definir filtro
     *
     * @param mixed Texto (categorias separadas por comas) o arreglo de textos, regiones a filtrar
     */
    public function definir_filtro($in_filtro) {
        // Iniciar propiedades
        $this->definido = FALSE;
        $this->filtro   = array();
        // Preparar filtro
        $filtro = Filtro::preparar_filtro($in_filtro);
        // Si hay filtro definido
        if (count($filtro) > 0) {
            // Consultar las regiones
            $regiones          = new \CatRegiones\Listado($this->sesion);
            $regiones->estatus = 'A';
            $regiones->consultar();
            // Conservar sólo las regiones que estén en la base de datos
            foreach ($regiones->listado as $r) {
                if (in_array($r['nombre'], $filtro)) {
                    $this->filtro[] = $r['nombre'];
                }
            }
            // Provocar excepción si queda vacío
            if (count($this->filtro) == 0) {
                throw new \Exception("Error: Ninguna región dada en el filtro existe en la base de datos.");
            }
        }
        // Leventar la bandera
        $this->definido = TRUE;
    } // definir_filtro

} // Clase FiltroRegiones

?>
