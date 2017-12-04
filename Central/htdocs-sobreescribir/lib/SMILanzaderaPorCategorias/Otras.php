<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorCategorias Otras
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
 * Clase Otras
 */
class Otras extends \Base2\Listado {

    // public $consultado;
    // protected $sesion;
    // public $listado;
    // public $panal;
    // public $cantidad_registros;
    // public $limit;
    // public $offset;
    public $estructura;           // Arreglo con la estructura de la tabla, se elabora aqui porque no es fija
    public $categoria;            // Texto, nombre de la categoría a filtrar
    public $region;               // Texto, nombre de la región a filtrar
    protected $filtro_categorias; // Instancia de FiltroCategorias
    protected $filtro_fuentes;    // Instancia de FiltroFuentes
    protected $filtro_regiones;   // Instancia de FiltroRegiones

    /**
     * Definir filtro por categorias
     *
     * @param array Instancia de FiltroCategorias
     */
    public function definir_filtro_categorias($in_filtro) {
        if ($in_filtro instanceof \SMILanzadera\FiltroCategorias) {
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
        if ($in_filtro instanceof \SMILanzadera\FiltroFuentes) {
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
        if ($in_filtro instanceof \SMILanzadera\FiltroRegiones) {
            $this->filtro_regiones = $in_filtro;
        } else {
            $this->filtro_regiones = NULL;
        }
    } // definir_filtro_regiones

    /**
     * Encabezado
     */
    public function encabezado() {
        if (($this->categoria != '') && ($this->region != '')) {
            return "{$this->region} con la categoría {$this->categoria}";
        } elseif ($this->region != '') {
            return $this->region;
        } elseif ($this->categoria != '') {
            return $this->categoria;
        } else {
            return "Todos los indicadores";
        }
    } // encabezado

    /**
     * Consultar
     */
    public function consultar() {
        // Error si se filtra por categoría y región al mismo tiempo
        if (($this->categoria != '') && ($this->region != '')) {
            throw new \Base2\ListadoExceptionVacio("No está programado el recibir al mismo tiempo filtros en categoría y región.");
        } elseif (($this->categoria == '') && ($this->region == '')) {
            throw new \Base2\ListadoExceptionVacio("No está programado el NO recibir ningún filtro.");
        }
        // Iniciar las propiedades
        $this->estructura = array();
        $this->listado    = array();
        $this->panal      = array();
        // Primer columna es el subindice
        $this->estructura['subindice_nom_corto'] = array(
            'enca'  => 'Subíndice',
            'pag'   => 'indsubindices.php',
            'id'    => 'subindice',
            'ancho' => 16);
        // Segunda columna en el indicador
        $this->estructura['indicador_nombre'] = array(
            'enca'  => 'Indicador',
            'pag'   => 'indindicadores.php',
            'id'    => 'indicador',
            'ancho' => 40);
        // Consultar las otras regiones
        $regiones = new \SMILanzadera\RegionesOtrasListado($this->sesion);
        $regiones->consultar();
        // Bucle por las regiones para los encabezados
        foreach ($regiones->listado as $r) {
            // Si se definió el filtro por regiones
            if (is_object($this->filtro_regiones) && ($this->filtro_regiones->filtrar($r['nombre']) === FALSE)) {
                continue; // El filtro ordena que se salte
            }
            // Si hay que elaborar la matriz para una única región
            if (($this->region != '') && ($this->region != $r['nombre'])) {
                continue; // Se salta
            }
            // Definir la clave
            $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($r['nombre']);
            // Acumular columna
            $this->estructura[$clave] = array(
                'enca'    => $r['nombre'],
                'clase'   => 'derecha',
                'color'   => $clave,
                'colores' => array('ND' => 'gris'),
                'ancho'   => 18);
        } // bucle regiones
        // Fecha de hoy
        $hoy = date('Y-m-d');
        // Instancia de Celda para no disponible
        $no_disponible = new \SMILanzadera\Celda('ND');
        // Consultar subindices
        $subindices          = new \IndSubindices\Listado($this->sesion);
        $subindices->estatus = 'A';
        $subindices->consultar();
        // Bucle por los subindices
        foreach ($subindices->listado as $s) {
            // Consultar indicadores
            $indicadores            = new \IndIndicadores\Listado($this->sesion);
            $indicadores->subindice = $s['id'];
            $indicadores->estatus   = 'A';
            try {
                $indicadores->consultar();
            } catch (\Base2\ListadoExceptionVacio $e) {
                continue; // Este subindice no tiene indicadores, se salta
            }
            // Bucle por los indicadores
            foreach ($indicadores->listado as $i) {
                // Si se definió el filtro por categorias
                if (is_object($this->filtro_categorias) && ($this->filtro_categorias->filtrar($i['categorias']) === FALSE)) {
                    continue; // El filtro ordena que se salte
                }
                // Si hay que elaborar la matriz para una única categoría
                if (($this->categoria != '') && !in_array($this->categoria, \SMILanzadera\Filtro::preparar_filtro($i['categorias']))) {
                    continue; // Se salta
                }
                // Acumularemos las celdas de la matriz en este arreglo
                $renglon = array();
                // Primer celda subindice
                $renglon['subindice']           = $s['id'];
                $renglon['subindice_nom_corto'] = $s['nom_corto'];
                // Segunda celda indicador
                $renglon['indicador']           = $i['id'];
                $renglon['indicador_nombre']    = $i['nombre'];
                // Para homologar la cantidad de decimales
                $cantidad_decimales = NULL;
                // Bucle por las regiones
                foreach ($regiones->listado as $r) {
                    // Si se definió el filtro por regiones
                    if (is_object($this->filtro_regiones) && ($this->filtro_regiones->filtrar($r['nombre']) === FALSE)) {
                        continue; // El filtro ordena que se salte
                    }
                    // Definir la clave
                    $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($r['nombre']);
                    // Consultar datos del indicador
                    $indicador_datos            = new \SMILanzadera\IndicadorDatosRegionListado($this->sesion);
                    $indicador_datos->region    = $r['id'];
                    $indicador_datos->indicador = $i['id'];
                    $indicador_datos->estatus   = 'A';
                    try {
                        $indicador_datos->consultar();
                        $indicador_datos->formatear();
                    } catch (\Base2\ListadoExceptionVacio $e) {
                        $renglon[$clave] = $no_disponible; // No hay datos
                        continue;
                    }
                    // Invertir el orden de los datos de los indicadores, del mas reciente al mas antiguo
                    arsort($indicador_datos->panal);
                    // Bucle datos del indicador, se interrumpira al agregar uno
                    $se_ha_agregado = FALSE;
                    foreach ($indicador_datos->panal as $d) {
                        // Si se definió el filtro por fuentes
                        if (is_object($this->filtro_fuentes) && ($this->filtro_fuentes->filtrar($d['fuente_nombre']) === FALSE)) {
                            continue; // El filtro ordena que se salte
                        }
                        // Si la fecha es anterior al dia de hoy
                        if (strcmp($d['fecha']->valor, $hoy) < 0) {
                            // Mostraremos el valor de esa Celda
                            $celda           = $d['valor']; // Es instancia de Celda
                            $celda->tooltip  = sprintf('%s, %s, %s', $i['unidad_nombre'], $d['fecha']->formatear(), $d['fuente_nombre']);
                            $renglon[$clave] = $celda;
                            // Si tiene decimales, se guarda esa cantidad de decimales para aplicarla a todo el renglon
                            if ($celda->contar_decimales() !== NULL) {
                                if (($cantidad_decimales === NULL) || ($celda->contar_decimales() > $cantidad_decimales)) {
                                    $cantidad_decimales = $celda->contar_decimales();
                                }
                            }
                            $se_ha_agregado = TRUE;
                            break;
                        }
                    }
                    // Si no se ha agregado la celda, entonces todos los datos son del futuro
                    if ($se_ha_agregado == FALSE) {
                        $renglon[$clave] = $no_disponible; // No hay datos
                    }
                } // bucle regiones
                // Segundo bucle regiones
                $hay_definidos = FALSE;
                foreach ($regiones->listado as $r) {
                    $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($r['nombre']);
                    if (isset($renglon[$clave])) {
                        // Si la Celda NO es No Disponible
                        if ($renglon[$clave] != $no_disponible) {
                            $hay_definidos = TRUE;
                        }
                        // Si hay cantidad de decimales, definir la cantidad de decimales del renglon
                        if ($cantidad_decimales !== NULL) {
                            $renglon[$clave]->decimales = $cantidad_decimales;
                        }
                    }
                }
                // Si hay datos, acumular renglón
                if ($hay_definidos) {
                    $this->panal[] = $renglon;
                }
            } // bucle indicadores
        } // bucle subindices
        // Si no se acumularon renglones
        if (count($this->panal) == 0) {
            throw new \Base2\ListadoExceptionVacio("Aviso en Otras: No hay datos.");
        }
        // Definir otras propiedades
        $this->definir_listado_desde_panal();
        $this->cantidad_registros = count($this->panal);
        // Levantar la bandera
        $this->consultado = TRUE;
    } // consultar

} // Clase Otras

?>
