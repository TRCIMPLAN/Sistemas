<?php
/**
 * TrcIMPLAN Central - OrgVinculos PublicacionesRelacionadasHTML
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
 * Clase PublicacionesRelacionadasHTML
 */
class PublicacionesRelacionadasHTML extends PublicacionesRelacionadas {

    // public $mensajes;                   // Texto con los mensajes
    // protected $vinculo;                 // Instancia de \OrgVinculos\Registro con el vínculo de la publicación
    // protected $arboles;                 // Arreglo con el listado con los árboles
    // protected $vinculos;                // Arreglo de instancias \OrgVinculos\Registro
    protected $vinculos_cantidad_max = 10; // Entero. Cantidad máxima de vínculos a mostrar por árbol

    /**
     * HTML
     *
     * @return string Código HTML
     */
    public function html() {
        // Validar que se haya consultado el vínculo, debe ser con el método consultar_vinculo
        if (!$this->vinculo instanceof Publicacion) {
            throw new \Exception("Error en Publicaciones Relacionadas TXT: No se ha consultado el vínculo.");
        }
        // Acumularemos el texto que se va a entregar en este arreglo
        $salida = array();
        // Encabezado
        $salida[] = '<h3>Publicaciones relacionadas</h3>';
        // Consultar árboles
        $arboles = $this->consultar_arboles();
        // Bucle por los árboles
        foreach ($arboles as $a) {
            // Consultar
            $vinculos_relacionados = $this->consultar_vinculos_relacionadas_del_arbol($a['id']);
            // Sólo si hay vínculos
            if (count($vinculos_relacionados) > 0) {
                // Acumular nombre del árbol, inicia lista no ordenada
                $salida[] = sprintf('<p><b>%s</b></p>', $a['nombre']);
                $salida[] = '<ul>';
                // Iniciar contador
                $c = 0;
                // Bucle por los vínculos relacionados
                foreach ($vinculos_relacionados as $v) {
                    // Consultar el vínculo
                    $v->consultar();
                    // Acumular enlace a la publicación relacionada
                    $salida[] = sprintf('  <li><a href="%s">%s</a></li>', $v->url, htmlentities($v->nombre));
                    // Incrementar contador, si llega a la cantidad máxima se sale del bucle
                    $c++;
                    if ($c >= $this->vinculos_cantidad_max) {
                        break;
                    }
                }
                $salida[] = '</ul>';
            }
        }
        // Entregar salida
        return implode("\n", $salida);
    } // html

} // Clase PublicacionesRelacionadasHTML

?>
