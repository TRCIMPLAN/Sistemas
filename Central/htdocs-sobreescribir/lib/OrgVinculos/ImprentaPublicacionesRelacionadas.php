<?php
/**
 * TrcIMPLAN Central - OrgVinculos Imprenta Publicaciones Relacionadas
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
 * Clase ImprentaPublicacionesRelacionadas
 *
 * Crea los archivos HTML para el extra que se incluye en cada SchemaArticle
 * El contenido es elaborado por PublicacionesRelacionadasHTML
 */
class ImprentaPublicacionesRelacionadas extends Imprenta {

    // public $mensajes;
    // protected $sesion;
    // protected $sitio_web_directorio;
    protected $include_directorio = 'include/extra'; // Nombre del directorio donde se depositarán los archivos generados

    /**
     * Imprimir
     */
    public function imprimir() {
        // Consultar vínculos
        $vinculos          = new Listado($this->sesion);
        $vinculos->estatus = 'A';
        $vinculos->consultar();
        // Bucle por los vínculos
        foreach ($vinculos->listado as $a) {
            // Definir el directorio a crear
            $directorio = sprintf('%s/%s', $this->include_directorio, $a['directorio']);
            if ($this->crear_directorio($directorio) == true) {
                // Poner una 'd' por cada directorio creado
                echo 'd';
            }
            // Definir la ruta donde se va crear el archivo HTML con el extra
            $archivo = sprintf('%s.html', $a['archivo']);
            $ruta    = sprintf('%s/%s', $directorio, $archivo);
            // Elaborar el contenido HTML
            $contenido = new PublicacionesRelacionadasHTML($this->sesion);
            $contenido->consultar_vinculo($a['id']);
            // Escribir el archivo HTML
            $this->crear_archivo($ruta, $contenido->html());
            // Poner un punto por cada archivo creado
            echo '.';
        }
    } // imprimir

} // Clase ImprentaPublicacionesRelacionadas

?>
