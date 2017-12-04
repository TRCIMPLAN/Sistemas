<?php
/**
 * TrcIMPLAN Central - SIGLanzadera Ficha
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

namespace SIGLanzadera;

/**
 * Clase Ficha
 *
 * Consulta un mapa
 */
class Ficha extends \Base2\Registro {

    // protected $sesion;
    // protected $consultado;
    protected $mapa;     // Instancia de \SigMapas\Registro
    protected $autor;    // Instancia de \SigAutores\Registro
    protected $imprenta; // Instancia de \SigImprentas\Registro
    protected $region;   // Instancia de \CatRegiones\Registro

    /**
     * Consultar
     *
     * @param integer ID del Mapa
     */
    public function consultar($in_mapa_id=false) {
        // Si YA se ha consultado, no hace nada
        if ($this->consultado) {
            return;
        }
        // Consultar Mapa
        $mapa = new \SigMapas\Registro($this->sesion);
        $mapa->consultar($in_mapa_id);
        if ($mapa->estatus != 'A') {
            throw new \Exception("Error en Reporte, consultar: El mapa {$mapa->nombre} está eliminado.");
        }
        // Consultar Autor
        $autor = new \SigAutores\Registro($this->sesion);
        $autor->consultar($mapa->autor);
        // Consultar Imprenta
        $imprenta = new \SigImprentas\Registro($this->sesion);
        $imprenta->consultar($mapa->imprenta);
        // Consultar Region
        $region = new \CatRegiones\Registro($this->sesion);
        $region->consultar($mapa->region);
        // Cargar las propiedades
        $this->mapa     = $mapa;
        $this->autor    = $autor;
        $this->imprenta = $imprenta;
        $this->region   = $region;
        // Levantar la bandera
        $this->consultado = true;
    } // consultar

    /**
     * Encabezado
     *
     * @return string Encabezado
     */
    public function encabezado() {
        return 'Ficha';
    } // encabezado

    /**
     * Formato arreglo PHP
     *
     * Convierte un texto separado por comas en una declaración de arreglo PHP
     *
     * @param  string Texto separado por comas
     * @return string Código PHP
     */
    protected function formato_arreglo_php($texto_separado_comas) {
        $a = array();
        foreach (explode(',', $texto_separado_comas) as $c) {
            $a[] = "'".ucwords(strtolower(trim($c)))."'";
        }
        return 'array('.implode(', ', $a).')';
    } // formato_arreglo_php

} // Clase Ficha

?>
