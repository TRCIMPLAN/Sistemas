<?php
/**
 * TrcIMPLAN Central - IndMatriz Listado
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

namespace IndMatriz;

/**
 * Clase Listado
 */
class Listado extends \Base2\Listado {

    public $categoria;     // Filtro por categoria, texto
    public $region;        // Filtro por region, id de la region
    public $region_nombre; // Nombre de la region
    public $estructura;    // Estructura de la tabla, se elabora aqui porque no es fija, toma las regiones
    public $tooltips;      // Como listado, contiene los tooltips para cada celda
    public $formatos;      // Como listado, contiene los formatos para cada celda
    static public $param_categoria = 'categoria';
    static public $param_region    = 'region';

    /**
     * Validar
     */
    public function validar() {
        // VALIDAR PERMISO
        if (!$this->sesion->puede_ver('ind_matriz')) {
            throw new \Exception('Aviso: No tiene permiso para ver matrices.');
        }
        // VALIDAR CATEGORIA
        if (($this->categoria != '') && !\Base2\UtileriasParaValidar::validar_frase($this->categoria)) {
            throw new \Base2\ListadoExceptionValidacion('Aviso: Categoría incorrecta.');
        }
        // VALIDAR REGION
        if ($this->region != '') {
            $region = new \CatRegiones\Registro($this->sesion);
            $region->consultar($this->region); // Puede causar una excepción
            $this->region_nombre = $region->nombre;
        }
        // ARREGLO ASOCIATIVO CON LOS PARAMETROS DE LA FORMA VARIABLE => VALOR
        if ($this->categoria != '') {
            $this->filtros_param[self::$param_categoria] = $this->categoria;
        }
        if ($this->region != '') {
            $this->filtros_param[self::$param_region] = $this->region;
        }
        // EJECUTAR METODO DEL PADRE
        parent::validar();
    } // validar

    /**
     * Encabezado
     *
     * @return string Texto del encabezado
     */
    public function encabezado() {
        if (($this->categoria != '') && ($this->region != '')) {
            return "Indicadores de {$this->region_nombre} en la categoría {$this->categoria}";
        } elseif ($this->region != '') {
            return "Indicadores de {$this->region_nombre}";
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
        // VALIDAR
        $this->validar(); // PUEDE CAUSAR EXCEPCION
        // INICIAR LAS PROPIEDADES
        $this->estructura = array();
        $this->listado    = array();
        $this->panal      = array();
        // PRIMER COLUMNA ES EL SUBINDICE
        $this->estructura['subindice_nom_corto'] = array(
            'enca'  => 'Subíndice',
            'pag'   => 'indsubindices.php',
            'id'    => 'subindice',
            'ancho' => 16);
        // SEGUNDA COLUMNA EN EL INDICADOR
        $this->estructura['indicador_nombre'] = array(
            'enca'  => 'Indicador',
            'pag'   => 'indindicadores.php',
            'id'    => 'indicador',
            'ancho' => 40);
        // SI SE HA DEFINIDO EL FILTRO POR REGION
        if ($this->region != '') {
            // TERCER COLUMNA CON SOLO ESTA REGION
            $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($this->region_nombre);
            $this->estructura[$clave] = array(
                'enca'    => $this->region_nombre,
                'clase'   => 'derecha',
                'color'   => $clave,
                'colores' => array('ND' => 'gris'),
                'ancho'   => 18);
        } else {
            // AGREGAR MAS COLUMNAS AL CONSULTAR REGIONES METROPOLITANAS
            $regiones = new RegionesMetropolitanasListado($this->sesion);
            $regiones->consultar(); // PUEDE CAUSAR UNA EXCEPCION
            // BUCLE CON LAS REGIONES METROPOLITANAS
            foreach ($regiones->listado as $r) {
                // DESDE LA TERCER COLUMNA SON LAS REGIONES
                $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($r['nombre']);
                $this->estructura[$clave] = array(
                    'enca'    => $r['nombre'],
                    'clase'   => 'derecha',
                    'color'   => $clave,
                    'colores' => array('ND' => 'gris'),
                    'ancho'   => 18);
            }
        }
        // FECHA DE HOY
        $hoy = date('Y-m-d');
        // INSTANCIA DE Celda PARA No Disponible
        $no_disponible = new \Base2\Celda('ND');
        // CONSULTAR SUBINDICES
        $subindices          = new \IndSubindices\Listado($this->sesion);
        $subindices->estatus = 'A';
        $subindices->consultar(); // PUEDE CAUSAR UNA EXCEPCION
        // BUCLE SUBINDICES
        foreach ($subindices->listado as $s) {
            // CONSULTAR INDICADORES
            $indicadores            = new \IndIndicadores\Listado($this->sesion);
            $indicadores->subindice = $s['id'];
            $indicadores->estatus   = 'A';
            try {
                $indicadores->consultar();
            } catch (\Base2\ListadoExceptionVacio $e) {
                continue; // ESTE SUBINDICE NO TIENE INDICADORES, SE SALTA
            }
            // BUCLE INDICADORES
            foreach ($indicadores->listado as $i) {
                // SI SE HA DEFINIDO LA CATEGORIA, LA COMPARAMOS, SI EL INDICADOR NO TIENE DICHA CATEGORIA SE SALTA
                if (($this->categoria != '') && (strpos($i['categorias'], $this->categoria) === false)) {
                    continue;
                }
                // ACUMULAREMOS LAS CELDAS DE LA MATRIZ EN ESTE ARREGLO
                $renglon = array();
                // PRIMER CELDA SUBINDICE
                $renglon['subindice']           = $s['id'];
                $renglon['subindice_nom_corto'] = $s['nom_corto'];
                // SEGUNDA CELDA INDICADOR
                $renglon['indicador']           = $i['id'];
                $renglon['indicador_nombre']    = $i['nombre'];
                // BUCLE CON LAS REGIONES METROPOLITANAS
                $cantidad_decimales = null;
                // SI SE HA DEFINIDO EL FILTRO POR REGION
                if ($this->region != '') {
                    // LA CLAVE ES LA REGION
                    $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($this->region_nombre);
                    // CONSULTAR DATOS DEL INDICADOR EN ESA REGION
                    $indicador_datos            = new IndicadorDatosRegionListado($this->sesion);
                    $indicador_datos->region    = $this->region;
                    $indicador_datos->indicador = $i['id'];
                    try {
                        $indicador_datos->consultar();
                        $indicador_datos->formatear();
                    } catch (\Base2\ListadoExceptionVacio $e) {
                        $renglon[$clave] = $no_disponible; // NO HAY DATOS
                        continue;
                    }
                    // INVERTIR EL ORDEN DE LOS DATOS DE LOS INDICADORES, DEL MAS RECIENTE AL MAS ANTIGUO
                    arsort($indicador_datos->panal);
                    // BUCLE DATOS DEL INDICADOR, SE INTERRUMPIRA AL AGREGAR UNO
                    $se_ha_agregado = false;
                    foreach ($indicador_datos->panal as $d) {
                        // SI LA FECHA ES ANTERIOR AL DIA DE HOY
                        if (strcmp($d['fecha']->valor, $hoy) < 0) {
                            // MOSTRAREMOS EL VALOR DE ESA Celda
                            $celda           = $d['valor']; // ES INSTANCIA DE Celda
                            $celda->tooltip  = sprintf('%s, %s, %s', $i['unidad_nombre'], $d['fecha']->formatear(), $d['fuente_nombre']);
                            $renglon[$clave] = $celda;
                            $se_ha_agregado  = true;
                            break;
                        }
                    }
                    // SI NO SE HA AGREGADO LA Celda, ENTONCES TODOS LOS DATOS SON DEL FUTURO
                    if ($se_ha_agregado == false) {
                        $renglon[$clave] = $no_disponible; // NO HAY DATOS
                    }
                } else {
                    foreach ($regiones->listado as $r) {
                        // LA CLAVE ES LA REGION
                        $clave = \Base2\UtileriasParaFormatos::caracteres_para_web($r['nombre']);
                        // CONSULTAR DATOS DEL INDICADOR EN ESA REGION
                        $indicador_datos            = new IndicadorDatosRegionListado($this->sesion);
                        $indicador_datos->region    = $r['id'];
                        $indicador_datos->indicador = $i['id'];
                        try {
                            $indicador_datos->consultar();
                            $indicador_datos->formatear();
                        } catch (\Base2\ListadoExceptionVacio $e) {
                            $renglon[$clave] = $no_disponible; // NO HAY DATOS
                            continue;
                        }
                        // INVERTIR EL ORDEN DE LOS DATOS DE LOS INDICADORES, DEL MAS RECIENTE AL MAS ANTIGUO
                        arsort($indicador_datos->panal);
                        // BUCLE DATOS DEL INDICADOR, SE INTERRUMPIRA AL AGREGAR UNO
                        $se_ha_agregado = false;
                        foreach ($indicador_datos->panal as $d) {
                            // SI LA FECHA ES ANTERIOR AL DIA DE HOY
                            if (strcmp($d['fecha']->valor, $hoy) < 0) {
                                // MOSTRAREMOS EL VALOR DE ESA Celda
                                $celda           = $d['valor']; // ES INSTANCIA DE Celda
                                $celda->tooltip  = sprintf('%s, %s, %s', $i['unidad_nombre'], $d['fecha']->formatear(), $d['fuente_nombre']);
                                $renglon[$clave] = $celda;
                                // SI TIENE DECIMALES, SE GUARDA ESA CANTIDAD DE DECIMALES PARA APLICARLA A TODO EL RENGLON
                                if ($celda->contar_decimales() !== null) {
                                    if (($cantidad_decimales === null) || ($celda->contar_decimales() > $cantidad_decimales)) {
                                        $cantidad_decimales = $celda->contar_decimales();
                                    }
                                }
                                $se_ha_agregado = true;
                                break;
                            }
                        }
                        // SI NO SE HA AGREGADO LA Celda, ENTONCES TODOS LOS DATOS SON DEL FUTURO
                        if ($se_ha_agregado == false) {
                            $renglon[$clave] = $no_disponible; // NO HAY DATOS
                        }
                    }
                    // SEGUNDO BUCLE PARA DEFINIR LA CANTIDAD DE DECIMALES DEL RENGLON
                    if ($cantidad_decimales !== null) {
                        foreach ($regiones->listado as $r) {
                            $clave                      = \Base2\UtileriasParaFormatos::caracteres_para_web($r['nombre']);
                            $renglon[$clave]->decimales = $cantidad_decimales;
                        }
                    }
                }
                // ACUMULAR EN PANAL
                $this->panal[] = $renglon;
            }
        }
        // SI NO SE ACUMULARON RENGLONES
        if (count($this->panal) == 0) {
            if (($this->categoria != '') && ($this->region != '')) {
                throw new \Base2\ListadoExceptionVacio("Aviso: No hay datos para la categoría {$this->categoria} en {$this->region_nombre}.");
            } elseif ($this->categoria != '') {
                throw new \Base2\ListadoExceptionVacio("Aviso: No hay datos para la categoría {$this->categoria}.");
            } elseif ($this->region != '') {
                throw new \Base2\ListadoExceptionVacio("Aviso: No hay datos para la región {$this->region_nombre}.");
            } else {
                throw new \Base2\ListadoExceptionVacio("Aviso: No hay datos.");
            }
        }
        // DEFINIR LAS OTRAS PROPIEDADES
        $this->definir_listado_desde_panal();
        $this->cantidad_registros = count($this->panal);
    } // consultar

} // Clase Listado

?>
