<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorCategorias PublicadorSMI
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

namespace SMILanzaderaPorCategorias;

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
        $this->mensajes[] = "SMILanzaderaPorCategorias";
        echo "SMILanzaderaPorCategorias ";
        // Eliminar directorio y archivos
        $this->eliminar_directorio("lib/SMICategorias");
        // Iniciar MatrizPHP
        $categoria_php = new CategoriaPHP($this->sesion);
        $categoria_php->definir_filtro_categorias($this->filtro_categorias);
        $categoria_php->definir_filtro_fuentes($this->filtro_fuentes);
        $categoria_php->definir_filtro_regiones($this->filtro_regiones);
        // Cargar categorías
        $categorias = new \IndCategorias\Listado($this->sesion);
        $categorias->consultar();
        // Bucle por categorías
        $contador = 0;
        foreach ($categorias->listado as $c) {
            // Si se definió el filtro por categorias
            if ($this->filtro_categorias instanceof \SMILanzadera\FiltroCategorias) {
                if ($this->filtro_categorias->filtrar($c) === FALSE) {
                    continue; // No está incluida, se salta
                }
            }
            // Crear Matriz
            $categoria_php->consultar($c['nombre']);
            $this->crear_archivo($categoria_php->ruta(), $categoria_php->php());
            echo ".";
            $this->mensajes[] = sprintf('  %s', $categoria_php->ruta());
            $contador++;
        } // bucle categorías
        // Crear la imprenta
        if ($contador > 0) {
            $elaborador_php = new ElaboradorPHPImprenta($this->sesion);
            $this->crear_archivo($elaborador_php->ruta(), $elaborador_php->php());
            echo "i";
            $this->mensajes[] = sprintf('  %s', $elaborador_php->ruta());
        } else {
            echo "sin publicaciones";
        }
        echo "\n";
        // Entregar mensajes
        return implode("\n", $this->mensajes);
    } // publicar

} // Clase PublicadorSMI

?>
