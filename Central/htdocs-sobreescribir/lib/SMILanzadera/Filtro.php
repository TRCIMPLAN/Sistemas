<?php
/**
 * TrcIMPLAN Central - SMILanzadera Filtro
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
 * Clase abstracta Filtro
 */
abstract class Filtro {

    protected $filtro   = array(); // Arreglo con textos, categorías que ya se comprobó que están en la base de datos
    protected $sesion;             // Instancia de /Inicio/Sesion
    protected $definido = FALSE;   // Bandera

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // contructor

    /**
     * Preparar filtro
     *
     * En definir_filtro puede recibirse textos o arreglos, este método siempre entrega un arreglo con textos
     *
     * @param  mixed Texto o arreglo con textos
     * @return array Arreglo con textos
     */
    static public function preparar_filtro($in_filtro) {
        // Validar parámetro
        if (is_array($in_filtro)) {
            // Si es un arreglo vacío, se va a permitir cualquiera
            if (count($in_filtro) == 0) {
                return array();
            } else {
                $filtro = $in_filtro;
            }
        } elseif (is_string($in_filtro)) {
            // Si es un texto vacío, se va a permitir cualquiera
            if (strlen(trim($in_filtro)) == 0) {
                return array();
            } else {
                $filtro = array();
                foreach (explode(',', $in_filtro) as $item) {
                    $filtro[] = trim($item);
                }
            }
        } elseif (is_null($in_filtro)) {
            return array(); // Es nulo, se va a permitir cualquiera
        } else {
            throw new \Exception("Error: El filtro no es válido.");
        }
        // Entregar
        return $filtro;
    } // preparar_filtro

    /**
     * Definir filtro
     *
     * @param mixed Texto (categorias separadas por comas) o arreglo de textos, categorías a filtrar
     */
    abstract public function definir_filtro($in_filtro);

    /**
     * Entregar filtro
     *
     * @return array Arreglo con textos
     */
    public function entregar_filtro() {
        return $this->filtro;
    } // entregar_filtro

    /**
     * Filtrar
     *
     * Entrega verdadero si una de las categorías está permitida
     *
     * @param  mixed   Texto (categorias/fuentes/regiones separadas por comas) o arreglo de textos a filtrar
     * @return boolean Verdadero si el filtro la permite, falso si no
     */
    public function filtrar($in_entradas) {
        // Si NO hay filtro
        if (count($this->filtro) === 0) {
            return TRUE; // Cualquiera pasa
        }
        // Validar parámetro
        if (is_array($in_entradas)) {
            if (count($in_entradas) == 0) {
                return FALSE; // No tiene nada
            } else {
                $entradas = $in_entradas;
            }
        } elseif (is_string($in_entradas)) {
            if (strlen(trim($in_entradas)) == 0) {
                return FALSE; // No tiene nada
            } else {
                $entradas = array();
                foreach (explode(',', $in_entradas) as $item) {
                    $entradas[] = trim($item);
                }
            }
        } elseif (is_null($in_entradas)) {
            return FALSE; // No tiene nada
        } else {
            throw new \Exception("Error en Filtro: La entrada no es válida.");
        }
        // Si NO se definió
        if ($this->definido == FALSE) {
            return TRUE; // No se definió el filtro, entonces todo pasa
        } else {
            foreach ($entradas as $e) {
                if (in_array($e, $this->filtro)) {
                    return TRUE; // Sí tiene esta categoría/fuente/región permitida
                }
            }
            return FALSE; // Terminó el bucle sin encontrar ninguna categoría permitida
        }
    } // filtrar

} // Clase abstracta Filtro

?>
