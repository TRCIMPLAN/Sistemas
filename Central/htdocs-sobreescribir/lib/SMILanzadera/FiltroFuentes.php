<?php
/**
 * TrcIMPLAN Central - SMILanzadera FiltroFuentes
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
 * Clase FiltroFuentes
 *
 * En esta clase se encapsula el procedimiento de definir y filtrar por fuentes.
 * Es sensible a las mayúsculas y minúsculas.
 * Si no se ejecuta definir_filtro o tiene un parámetro nulo, no filtrará y permitirá cualquier valor.
 * Ejemplo:
 *     $filtro = new FiltroFuentes($sesion);
 *     $filtro->definir_filtro("INEGI, IMCO, IMPLAN"); // También puede recibir un arreglo de textos
 *     if ($filtro->filtrar("IMSS, IMCO")) { echo("Sí contiene una región permitida"); }
 */
class FiltroFuentes extends Filtro {

    // protected $filtro;
    // protected $sesion;
    // protected $definido;

    /**
     * Definir filtro
     *
     * @param mixed Texto (fuentes separadas por comas) o arreglo de textos, fuentes a filtrar
     */
    public function definir_filtro($in_filtro) {
        // Iniciar propiedades
        $this->definido = FALSE;
        $this->filtro   = array();
        // Preparar filtro
        $filtro = Filtro::preparar_filtro($in_filtro);
        // Si hay filtro definido
        if (count($filtro) > 0) {
            // Consultar las fuentes
            $fuentes          = new \CatFuentes\Listado($this->sesion);
            $fuentes->estatus = 'A';
            $fuentes->consultar();
            // Conservar sólo las fuentes que estén en la base de datos
            foreach ($fuentes->listado as $f) {
                if (in_array($f['nombre'], $filtro)) {
                    $this->filtro[] = $f['nombre'];
                }
            }
            // Provocar excepción si queda vacío
            if (count($this->filtro) == 0) {
                throw new \Exception("Error: Ninguna fuente dada en el filtro existe en la base de datos.");
            }
        }
        // Leventar la bandera
        $this->definido = TRUE;
    } // definir_filtro

} // Clase FiltroFuentes

?>
