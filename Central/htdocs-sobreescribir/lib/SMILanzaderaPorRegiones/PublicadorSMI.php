<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorRegiones PublicadorSMI
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

namespace SMILanzaderaPorRegiones;

/**
 * Clase PublicadorSMI
 */
class PublicadorSMI extends \SMILanzadera\Publicador {

    // public $mensajes;
    // protected $sesion;
    // protected $sitio_web_directorio;
    // protected $filtro_categorias;
    // protected $filtro_fuentes;
    // protected $filtro_regiones;

    /**
     * Publicar
     *
     * @return string Mensajes para la terminal
     */
    public function publicar() {
        // Acumular mensaje de inicio
        $this->mensajes[] = "SMILanzaderaPorRegiones";
        echo "SMILanzaderaPorRegiones ";
        // Crear archivo
        $por_regiones_php = new PorRegionesPHP($this->sesion);
        $this->crear_archivo($por_regiones_php->ruta(), $por_regiones_php->php());
        echo ".";
        // Entregar mensajes
        echo "\n";
        return implode("\n", $this->mensajes);
    } // publicar

} // Clase PublicadorSMI

?>
