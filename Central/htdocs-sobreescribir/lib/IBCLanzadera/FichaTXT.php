<?php
/**
 * TrcIMPLAN Central - IBCLanzadera FichaTXT
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

namespace IBCLanzadera;

/**
 * Clase FichaTXT
 *
 * Toma los datos del conglomerado y le da forma en texto
 */
class FichaTXT extends Ficha {

    // protected $sesion;
    // protected $consultado;
    // protected $catalogos;
    // protected $conglomerado;
    // protected $procesados;
    // protected $fecha;

    /**
     * Texto
     *
     * @return string Texto
     */
    public function texto() {
        // Si NO se ha consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaTXT: No se ha consultado.");
        }
        // Acumularemos la entrega en este arreglo
        $a   = array();
        $a[] = "Nombre: {$this->conglomerado->nombre}";
        // Acumular
        $eje_actual = '';
        foreach ($this->catalogos->listado as $c) {
            // Si hay dato para ese catálogo
            if (array_key_exists($c['nivel'], $this->procesados)) {
                // Si cambia el eje, se pone en una línea
                if ($c['eje'] != $eje_actual) {
                    $eje_actual = $c['eje'];
                    $a[]        = sprintf('  %s', $c['eje_nom_corto']);
                }
                // Poner dato
                $a[] = sprintf('    %s: %s', $c['nombre'], $this->procesados[$c['nivel']]->texto());
            }
        }
        // Entregar
        return "\n".implode("\n", $a)."\n";
    } // texto

} // Clase FichaTXT

?>
