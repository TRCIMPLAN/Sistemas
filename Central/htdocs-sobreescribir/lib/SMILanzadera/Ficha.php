<?php
/**
 * TrcIMPLAN Central - SMILanzadera Ficha
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
 * Clase Ficha
 *
 * Consulta el Indicador y sus relaciones.
 */
class Ficha extends \Base2\Registro {

    // protected $sesion;
    // protected $consultado;
    public $region;                   // Instancia de \CatRegiones\Registro
    public $indicador;                // Instancia de \IndIndicadores\Registro
    public $indicador_datos;          // Instancia de IndicadorDatosRegionListado
    public $indicador_otras_regiones; // Instancia de IndicadorDatosOtrasRegionesListado
    public $indicador_mapas_region;   // Instancia de IndicadorMapasRegionListado
    public $fuentes;                  // Arreglo con las fuentes de los datos
    protected $filtro_categorias;     // Instancia de FiltroCategorias
    protected $filtro_fuentes;        // Instancia de FiltroFuentes
    protected $filtro_regiones;       // Instancia de FiltroRegiones

    /**
     * Definir filtro por categorias
     *
     * @param array Instancia de FiltroCategorias
     */
    public function definir_filtro_categorias($in_filtro) {
        if ($in_filtro instanceof FiltroCategorias) {
            $this->filtro_categorias = $in_filtro;
        } else {
            $this->filtro_categorias = NULL;
        }
    } // definir_filtro_categorias

    /**
     * Definir filtro por fuentes
     *
     * @param array Instancia de FiltroFuentes
     */
    public function definir_filtro_fuentes($in_filtro) {
        if ($in_filtro instanceof FiltroFuentes) {
            $this->filtro_fuentes = $in_filtro;
        } else {
            $this->filtro_fuentes = NULL;
        }
    } // definir_filtro_fuentes

    /**
     * Definir filtro por regiones
     *
     * @param array Instancia de FiltroRegiones
     */
    public function definir_filtro_regiones($in_filtro) {
        if ($in_filtro instanceof FiltroRegiones) {
            $this->filtro_regiones = $in_filtro;
        } else {
            $this->filtro_regiones = NULL;
        }
    } // definir_filtro_regiones

    /**
     * Consultar
     *
     * @param integer ID de la Región
     * @param integer ID del Indicador
     */
    public function consultar($in_region=FALSE, $in_indicador=FALSE) {
        // Parámetro región
        if ($in_region === FALSE) {
            throw new \Exception("Error en Ficha: Falta el id de la región como parámetro al consultar.");
        }
        // Consultar Región
        $region = new \CatRegiones\Registro($this->sesion);
        $region->consultar($in_region);
        // Si el estatus de la Región es ELIMINADO, se provoca una excepción
        if ($region->estatus != 'A') {
            throw new FichaExceptionValidacion("Error en Ficha, consultar: La Región {$region->nombre} está eliminada.");
        }
        // Si se definió el filtro por regiones
        if (is_object($this->filtro_regiones) && ($this->filtro_regiones->filtrar($region->nombre) === FALSE)) {
            throw new FichaExceptionVacio("Ficha vacía: El filtro por regiones ha descartado este indicador.");
        }
        // Parámetro indicador
        if ($in_indicador === FALSE) {
            throw new \Exception("Error en Ficha: Falta el id del indicador como parámetro al consultar.");
        }
        // Consultar Indicador
        $indicador = new \IndIndicadores\Registro($this->sesion);
        $indicador->consultar($in_indicador);
        // Si el estatus del Indicador es ELIMINADO, se provoca una excepción
        if ($indicador->estatus != 'A') {
            throw new FichaExceptionValidacion("Error en Ficha, consultar: El Indicador {$indicador->nombre} está eliminado.");
        }
        // Si se definió el filtro por categorias
        if (is_object($this->filtro_categorias) && ($this->filtro_categorias->filtrar($indicador->categorias) === FALSE)) {
            throw new FichaExceptionVacio("Ficha vacía: El filtro por categorías ha descartado este indicador.");
        }
        // Consultar Datos del Indicador, en la Región dada
        $indicador_datos            = new IndicadorDatosRegionListado($this->sesion);
        $indicador_datos->region    = $in_region;
        $indicador_datos->indicador = $in_indicador;
        $indicador_datos->definir_filtro_fuentes($this->filtro_fuentes);
        try {
            $indicador_datos->consultar();
            $indicador_datos->formatear();
        } catch (\Base2\ListadoExceptionVacio $e) {
            throw new FichaExceptionVacio("Ficha vacía: No hay datos para {$indicador->nombre} en {$region->nombre}.");
        }
        // Si hay varias fuentes en los datos
        $fuentes = array();
        foreach ($indicador_datos->panal as $celda) {
            if (!in_array($celda['fuente_nombre'], $fuentes)) {
                $fuentes[] = $celda['fuente_nombre'];
            }
        }
        // Si se definió el filtro por fuentes
        if (is_object($this->filtro_fuentes) && ($this->filtro_fuentes->filtrar($fuentes) === FALSE)) {
            throw new FichaExceptionVacio("Ficha vacía: El filtro por fuentes ha descartado este indicador.");
        }
        // Consultar Datos del Indicador en otras Regiones
        $indicador_otras_regiones                  = new IndicadorDatosOtrasRegionesListado($this->sesion);
        $indicador_otras_regiones->region_comparar = $in_region;
        $indicador_otras_regiones->indicador       = $in_indicador;
        $indicador_otras_regiones->definir_filtro_fuentes($this->filtro_fuentes);
        $indicador_otras_regiones->definir_filtro_regiones($this->filtro_regiones);
        try {
            $indicador_otras_regiones->consultar();
            $indicador_otras_regiones->formatear();
        } catch (\Base2\ListadoExceptionVacio $e) {
            unset($indicador_otras_regiones); // No hay datos en otras regiones
            $indicador_otras_regiones = FALSE;
        }
        // Consultar mapas
        $indicador_mapas_region            = new IndicadorMapasRegionListado($this->sesion);
        $indicador_mapas_region->region    = $in_region;
        $indicador_mapas_region->indicador = $in_indicador;
        try {
            $indicador_mapas_region->consultar();
        } catch (\Base2\ListadoExceptionVacio $e) {
            unset($indicador_mapas_region); // No hay mapas
            $indicador_mapas_region = FALSE;
        }
        // Cargar las propiedades
        $this->region                   = $region;
        $this->indicador                = $indicador;
        $this->indicador_datos          = $indicador_datos;
        $this->indicador_otras_regiones = $indicador_otras_regiones; // Puede ser FALSO
        $this->indicador_mapas_region   = $indicador_mapas_region;   // Puede ser FALSO
        $this->fuentes                  = $fuentes;
        // Levantar la bandera
        $this->consultado = TRUE;
    } // consultar

    /**
     * Encabezado
     *
     * @return string Encabezado
     */
    public function encabezado() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Entregar
        return "{$this->indicador->nombre} en {$this->region->nombre}";
    } // encabezado

} // Ficha

?>
