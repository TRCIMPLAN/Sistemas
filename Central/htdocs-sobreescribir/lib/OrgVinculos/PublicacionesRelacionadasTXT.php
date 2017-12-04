<?php
/**
 * TrcIMPLAN Central - OrgVinculos PublicacionesRelacionadasTXT
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
 * Clase PublicacionesRelacionadasTXT
 */
class PublicacionesRelacionadasTXT extends PublicacionesRelacionadas {

    // public $mensajes;                   // Texto con los mensajes
    // protected $vinculo;                 // Instancia de \OrgVinculos\Registro con el vínculo de la publicación
    // protected $arboles;                 // Arreglo con el listado con los árboles
    // protected $vinculos;                // Arreglo de instancias \OrgVinculos\Registro
    protected $vinculos_cantidad_max = 10; // Entero. Cantidad máxima de vínculos a mostrar por árbol

    /**
     * TXT
     *
     * @return string Texto
     */
    public function txt() {
        // Validar que se haya consultado el vínculo, debe ser con el método consultar_vinculo
        if (!$this->vinculo instanceof Publicacion) {
            throw new \Exception("Error en Publicaciones Relacionadas TXT: No se ha consultado el vínculo.");
        }
        // Acumularemos el texto que se va a entregar en este arreglo
        $salida = array();
        // Texto sobre el vínculo
        $salida[] = sprintf("Vínculo: %s", $this->vinculo->nombre);
        $salida[] = sprintf("  autores: %s", implode(', ', $this->vinculo->obtener_autores()));
        $salida[] = sprintf("  categorías: %s", implode(', ', $this->vinculo->obtener_categorias()));
        $salida[] = sprintf("  fuentes: %s", implode(', ', $this->vinculo->obtener_fuentes()));
        $salida[] = sprintf("  regiones: %s", implode(', ', $this->vinculo->obtener_regiones()));
        // Consultar árboles
        $arboles = $this->consultar_arboles();
        // Bucle por los árboles
        foreach ($arboles as $a) {
            // Consultar
            $vinculos_relacionados = $this->consultar_vinculos_relacionadas_del_arbol($a['id']);
            // Sólo si hay vínculos
            if (count($vinculos_relacionados) > 0) {
                // Acumular línea sobre árbol
                $salida[] = sprintf("Árbol: %s", $a['nom_corto']);
                // Iniciar contador
                $c = 0;
                // Bucle por los vínculos relacionados
                foreach ($vinculos_relacionados as $v) {
                    // Consultar el vínculo para mostrar en la línea información del mismo
                    $v->consultar();
                    // Acumular líneas sobre el vínculo
                    $salida[] = sprintf("  Vínculo %.4f = %s", $v->obtener_puntaje(), $v->obtener_puntaje_descrito());
                    $salida[] = sprintf("    nombre:     %s", $v->nombre);
                    $salida[] = sprintf("    creado:     %s", $v->creado);
                    $salida[] = sprintf("    autores:    %s", implode(', ', $v->obtener_autores()));
                    $salida[] = sprintf("    categorias: %s", implode(', ', $v->obtener_categorias()));
                    $salida[] = sprintf("    fuentes:    %s", implode(', ', $v->obtener_fuentes()));
                    $salida[] = sprintf("    regiones:   %s", implode(', ', $v->obtener_regiones()));
                    // Incrementar contador, si llega a la cantidad máxima se sale del bucle
                    $c++;
                    if ($c >= $this->vinculos_cantidad_max) {
                        break;
                    }
                }
            }
        }
        // Entregar salida
        return implode("\n", $salida);
    } // txt

} // Clase PublicacionesRelacionadasTXT

?>
