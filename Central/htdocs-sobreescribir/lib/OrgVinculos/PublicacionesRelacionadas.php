<?php
/**
 * TrcIMPLAN Central - OrgVinculos PublicacionesRelacionadas
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
 * Clase PublicacionesRelacionadas
 */
class PublicacionesRelacionadas {

    public $mensajes;    // Texto con los mensajes
    protected $vinculo;  // Instancia de \OrgVinculos\Registro con el vínculo de la publicación
    protected $arboles;  // Arreglo con el listado con los árboles
    protected $vinculos; // Arreglo de instancias \OrgVinculos\Registro

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        // Parámetro sesión
        $this->sesion = $in_sesion;
    } // constructor

    /**
     * Consultar árboles
     *
     * @return array Arreglo con el listado de \OrgArboles\Listado
     */
    protected function consultar_arboles() {
        // Consultar los árboles
        $this->arboles          = new \OrgArboles\Listado($this->sesion);
        $this->arboles->estatus = 'A';
        $this->arboles->consultar();
        // Entregar
        return $this->arboles->listado;
    } // consultar_arboles

    /**
     * Consultar vínculo
     *
     * @param  integer ID del vínculo a consultar
     * @return mixed   Instancia de Publicacion
     */
    public function consultar_vinculo($in_id) {
        // Consultar vínculo
        $this->vinculo = new Publicacion($this->sesion);
        $this->vinculo->consultar($in_id);
        // Entregar
        return $this->vinculo;
    } // consultar_vinculo

    /**
     * Consultar vínculos relacionadas del árbol
     *
     * @param  integer ID del árbol de donde se desean obtener los vínculos relacionadas
     * @return array   Arreglo con instancias de \OrgVinculos\Registro
     */
    public function consultar_vinculos_relacionadas_del_arbol($in_id) {
        // Inicializar arreglo
        $this->vinculos = array();
        // Acumularemos los mensajes en este arreglo
        $msg = array();
        // Validar que se haya consultado el vínculo primero
        if (!$this->vinculo instanceof Publicacion) {
            throw new \Exception("Error en Consultar vínculos relacionadas del árbol: No se ha consultado el vínculo.");
        }
        // Acumular mensaje
        $msg[] = sprintf("Vínculo %d: %s", $this->vinculo->id, $this->vinculo->nombre);
        // Consultar y validar el árbol
        $arbol = new \OrgArboles\Registro($this->sesion);
        $arbol->consultar($in_id);
        $msg[] = sprintf("  Árbol [%d] %s", $arbol->nivel, $arbol->nom_corto);
        // Consultar sólo los elementos que conciden con el árbol
        $elementos             = new \OrgElementos\Listado($this->sesion);
        $elementos->rama_arbol = $arbol->id;
        $elementos->estatus    = 'A';
        try {
            $elementos->consultar();
        } catch (\Base\ListadoExceptionVacio $e) {
            return $this->vinculos;
        } catch (\Base2\ListadoExceptionVacio $e) {
            return $this->vinculos;
        }
        // Acumularemos instancias de los vínculos relacionados en este arreglo
        $vinculos = array();
        // Bucle por los elementos
        foreach ($elementos->listado as $e) {
            $id = $e['vinculo'];
            // Evitar el vínculo del cual se hacen las publicaciones relacionadas se agregue
            if ($id != $this->vinculo->id) {
                $m = array();
                // Incrementar factor, note que NO se consulta la publicación para no hacerlo más lento
                if (array_key_exists($e['autor'], $this->vinculo->obtener_autores())) {
                    if (!array_key_exists($id, $vinculos)) {
                        $vinculos[$id] = new Publicacion($this->sesion);
                        $vinculos[$id]->iniciar_factor_creado($id, $e['creado']);
                    }
                    $vinculos[$id]->incrementar_factor_autor($e['autor']);
                    $m[] = $e['autor_nombre'];
                }
                if (array_key_exists($e['categoria'], $this->vinculo->obtener_categorias())) {
                    if (!array_key_exists($id, $vinculos)) {
                        $vinculos[$id] = new Publicacion($this->sesion);
                        $vinculos[$id]->iniciar_factor_creado($id, $e['creado']);
                    }
                    $vinculos[$id]->incrementar_factor_categoria($e['categoria']);
                    $m[] = $e['categoria_nombre'];
                }
                if (array_key_exists($e['fuente'], $this->vinculo->obtener_fuentes())) {
                    if (!array_key_exists($id, $vinculos)) {
                        $vinculos[$id] = new Publicacion($this->sesion);
                        $vinculos[$id]->iniciar_factor_creado($id, $e['creado']);
                    }
                    $vinculos[$id]->incrementar_factor_fuente($e['fuente']);
                    $m[] = $e['fuente_nombre'];
                }
                if (array_key_exists($e['region'], $this->vinculo->obtener_regiones())) {
                    if (!array_key_exists($id, $vinculos)) {
                        $vinculos[$id] = new Publicacion($this->sesion);
                        $vinculos[$id]->iniciar_factor_creado($id, $e['creado']);
                    }
                    $vinculos[$id]->incrementar_factor_region($e['region']);
                    $m[] = $e['region_nombre'];
                }
                if (count($m) > 0) {
                    $msg[] = sprintf("    Vínculo %s con %s", $e['vinculo_nombre'], implode(', ', $m));
                }
            }
        }
        // Si no hay vínculos relacionados
        if (count($vinculos) > 0) {
            // Acumularemos los puntajes de los vínculos en este arreglo
            $puntajes = array();
            // Bucle por vínculos
            foreach ($vinculos as $id => $v) {
                $puntajes[$id] = $v->obtener_puntaje();
            }
            // Ordenar por puntaje de mayor a menor
            arsort($puntajes);
            // Bucle por puntajes
            foreach ($puntajes as $id => $p) {
                // Acumular vínculo
                $this->vinculos[] = $vinculos[$id];
            }
        }
        // Juntar los mensajes
        $this->mensajes = implode("\n", $msg);
        // Entregar vínculos
        return $this->vinculos;
    } // consultar_vinculos_relacionadas_del_arbol

} // Clase PublicacionesRelacionadas

?>
