<?php
/**
 * TrcIMPLAN Central - OrgVinculos Publicacion
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
 * Clase Publicacion
 */
class Publicacion extends Registro {

    // protected $sesion;
    // protected $consultado;
    // public $id;
    // public $rama;
    // public $rama_nom_corto;
    // public $arbol_nom_corto;
    // public $nivel;
    // public $nombre;
    // public $descripcion;
    // public $creado;
    // public $directorio;
    // public $archivo;
    // public $url;
    // public $imagen;
    // public $imagen_previa;
    // public $estado;
    // public $estado_descrito;
    // public $para_compartir;
    // public $para_compartir_descrito;
    // public $estatus;
    // public $estatus_descrito;
    // static public $estado_descripciones;
    // static public $estado_colores;
    // static public $para_compartir_descripciones;
    // static public $para_compartir_colores;
    // static public $estatus_descripciones;
    // static public $estatus_colores;
    protected $elementos;                           // Instancia de \OrgElementos\Listado
    protected $factor_creado;                       // Flotante, factor de 0 (muy antiguo) a 1 (es de hoy)
    protected $factor_autores_ids     = array(); // Arreglo con los ID de los vínculos que tienen los mismos autores
    protected $factor_categorias_ids = array(); // Arreglo con los ID de los vínculos que tienen las mismas categorías
    protected $factor_fuentes_ids    = array(); // Arreglo con los ID de los vínculos que tienen las mismas fuentes
    protected $factor_regiones_ids    = array(); // Arreglo con los ID de los vínculos que tienen los mismos vínculos

    /**
     * Iniciar factor creador
     *
     * Recibe el ID del vínculo, para consultarse más adelante, así no se hace más lento el puntaje
     * Factor creado es un número flotante menor que uno, donde entre más cercano a uno es más reciente
     *
     * @param integer ID del vínculo
     * @param string  Fecha y hora de creación que viene del listado de elementos
     */
    public function iniciar_factor_creado($in_id, $in_creacion) {
        // Parámetro ID del vínculo
        $this->id = $in_id;
        // Convertir la fecha y hora dadas en un entero con los segundos desde el inicio del tiempo Unix
        $creacion_unix_timestamp = strtotime($in_creacion);
        // Definir Hoy en tiempo Unix
        $hoy_unix_timestamp = time();
        // Si es en el futuro, entregar un factor igual a cero
        if ($hoy_unix_timestamp < $creacion_unix_timestamp) {
            $this->factor_creado = (float) 0;
        } else {
            // Calcular cantidad de días desde que fue creado
            $dias = ($hoy_unix_timestamp - $creacion_unix_timestamp) / 86400;
            // Considerar un año en días
            $favorable_dias = 365;
            // Calcular el factor
            if (($favorable_dias - $dias) > 0) {
                $this->factor_creado = (float) ($favorable_dias - $dias) / $favorable_dias;
            } else {
                $this->factor_creado = (float) 0;
            }
        }
    } // iniciar_factor_creado

    /**
     * Incrementar factor autor
     *
     * @param integer ID del vínculo
     */
    public function incrementar_factor_autor($in_id) {
        if (!in_array($in_id, $this->factor_autores_ids)) {
            $this->factor_autores_ids[] = $in_id;
        }
    } // incrementar_factor_autor

    /**
     * Incrementar factor categoría
     *
     * @param integer ID del vínculo
     */
    public function incrementar_factor_categoria($in_id) {
        if (!in_array($in_id, $this->factor_categorias_ids)) {
            $this->factor_categorias_ids[] = $in_id;
        }
    } // incrementar_factor_categoria

    /**
     * Incrementar factor fuente
     *
     * @param integer ID del vínculo
     */
    public function incrementar_factor_fuente($in_id) {
        if (!in_array($in_id, $this->factor_fuentes_ids)) {
            $this->factor_fuentes_ids[] = $in_id;
        }
    } // incrementar_factor_fuente

    /**
     * Incrementar factor región
     *
     * @param integer ID del vínculo
     */
    public function incrementar_factor_region($in_id) {
        if (!in_array($in_id, $this->factor_regiones_ids)) {
            $this->factor_regiones_ids[] = $in_id;
        }
    } // incrementar_factor_region

    /**
     * Obtener puntaje
     *
     * Sumar todas las cantidades
     *
     * @return float Puntaje
     */
    public function obtener_puntaje() {
        return count($this->factor_autores_ids)
            + count($this->factor_categorias_ids) * 2
            + count($this->factor_fuentes_ids)
            + count($this->factor_regiones_ids) * 0.5
            + $this->factor_creado;
    } // obtener_puntaje

    /**
     * Obtener puntaje
     *
     * Mensaje con las cantidades de cada factor
     *
     * @return float Puntaje
     */
    public function obtener_puntaje_descrito() {
        return sprintf('autores %d + categorías %.1f + fuentes %d + regiones %.1f + creado %.4f',
            count($this->factor_autores_ids),
            count($this->factor_categorias_ids) * 2,
            count($this->factor_fuentes_ids),
            count($this->factor_regiones_ids) * 0.5,
            $this->factor_creado);
    } // obtener_puntaje_descrito

    /**
     * Consultar elementos
     */
    protected function consultar_elementos() {
        // Consultar elementos si no lo están
        if (!($this->elementos instanceof \OrgElementos\Listado)) {
            $this->elementos          = new \OrgElementos\Listado($this->sesion);
            $this->elementos->vinculo = $this->id;
            $this->elementos->estatus = 'A';
            $this->elementos->consultar();
        }
    } // consultar_elementos

    /**
     * Obtener autores
     *
     * @return array Arreglo asociativo autor_id => autor_nombre
     */
    public function obtener_autores() {
        // Consultar elementos
        $this->consultar_elementos();
        // Acumularemos los IDs en estos arreglos
        $autores = array();
        // Bucle por los elementos
        foreach ($this->elementos->listado as $e) {
            if ($e['autor'] > 1) {
                $autores[$e['autor']] = $e['autor_nombre'];
            }
        }
        // Entregar
        return $autores;
    } // obtener_autores

    /**
     * Obtener categorías
     *
     * @return array Arreglo asociativo categoria_id => categoria_nombre
     */
    public function obtener_categorias() {
        // Consultar elementos
        $this->consultar_elementos();
        // Acumularemos los IDs en estos arreglos
        $categorias = array();
        // Bucle por los elementos
        foreach ($this->elementos->listado as $e) {
            if ($e['categoria'] > 1) {
                $categorias[$e['categoria']] = $e['categoria_nombre'];
            }
        }
        // Entregar
        return $categorias;
    } // obtener_categorias

    /**
     * Obtener fuentes
     *
     * @return array Arreglo asociativo fuente_id => fuente_nombre
     */
    public function obtener_fuentes() {
        // Consultar elementos
        $this->consultar_elementos();
        // Acumularemos los IDs en estos arreglos
        $fuentes = array();
        // Bucle por los elementos
        foreach ($this->elementos->listado as $e) {
            if ($e['fuente'] > 1) {
                $fuentes[$e['fuente']] = $e['fuente_nombre'];
            }
        }
        // Entregar
        return $fuentes;
    } // obtener_categorias

    /**
     * Obtener regiones
     *
     * @return array Arreglo asociativo region_id => region_nombre
     */
    public function obtener_regiones() {
        // Consultar elementos
        $this->consultar_elementos();
        // Acumularemos los IDs en estos arreglos
        $regiones = array();
        // Bucle por los elementos
        foreach ($this->elementos->listado as $e) {
            if ($e['region'] > 1) {
                $regiones[$e['region']] = $e['region_nombre'];
            }
        }
        // Entregar
        return $regiones;
    } // obtener_regiones

} // Clase Publicacion

?>
