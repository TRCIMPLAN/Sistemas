<?php
/**
 * TrcIMPLAN Central - SMILanzadera IndicadorDatosOtrasRegionesListado
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
 * Clase IndicadorDatosOtrasRegionesListado
 */
class IndicadorDatosOtrasRegionesListado extends \IndIndicadoresDatos\Listado {

    // protected $sesion;       // Instancia con la sesión
    // public $consultado;      // Bandera
    // public $listado;         // Arreglo donde el método consultar deja la consulta
    // public $panal;           // Arreglo de arreglos con instancias de Celda que formatear armará
    // public $region;          // Entero, ID de la región
    // public $indicador;       // Entero, ID del indicador
    // public $estatus;         // Caracter, 'A' es EN USO, 'B' es ELIMINADO
    public $estructura = array(
        'region_nombre' => array('enca' => 'Región', 'ancho' => 24, 'formato' => 'texto'),
        'fecha'         => array('enca' => 'Fecha',  'ancho' => 10, 'formato' => 'fecha'),
        'valor'         => array('enca' => 'Dato',   'ancho' => 24),
        'fuente_nombre' => array('enca' => 'Fuente', 'ancho' => 24, 'formato' => 'texto'),
        'notas'         => array('enca' => 'Notas',  'ancho' => 48, 'formato' => 'texto'));
    public $region_comparar;    // Entero, ID de la región a comparar
    protected $filtro_fuentes;  // Instancia de FiltroFuentes
    protected $filtro_regiones; // Instancia de FiltroRegiones

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
        if ($in_filtro instanceof \SMILanzadera\FiltroRegiones) {
            $this->filtro_regiones = $in_filtro;
        } else {
            $this->filtro_regiones = NULL;
        }
    } // definir_filtro_regiones

    /**
     * Validar
     */
    public function validar() {
        // Validar filtro indicador
        if (!\Base2\UtileriasParaValidar::validar_entero($this->indicador)) {
            throw new \Base2\ListadoExceptionValidacion("Error en IndicadorDatosOtrasRegiones, validar: No ha definido el indicador.");
        }
        // Validar filtro región-comparar
        if (!\Base2\UtileriasParaValidar::validar_entero($this->region_comparar)) {
            throw new \Base2\ListadoExceptionValidacion("Error en IndicadorDatosOtrasRegiones, validar: No ha definido la región a comparar.");
        }
        // Siempre el estatus es EN USO
        $this->estatus = 'A';
        // Ejecutar padre
        parent::validar();
    } // validar

    /**
     * Consultar
     *
     * Hace uso del filtro por fuentes para dejar sólo los datos de las fuentes permitidas
     */
    public function consultar() {
        // Ejecutar consulta en el padre
        parent::consultar();
        // Si está definido el filtro por fuentes o por regiones
        if (($this->filtro_fuentes instanceof FiltroFuentes) || ($this->filtro_regiones instanceof FiltroRegiones)) {
            // Iniciar arreglo donde acumularemos los datos que sí se permitan
            $a = array();
            // Bucle en listado
            foreach ($this->listado as $dato) {
                if ((($this->filtro_fuentes instanceof FiltroFuentes) && ($this->filtro_fuentes->filtrar($dato['fuente_nombre']) == TRUE))
                    && (($this->filtro_regiones instanceof FiltroRegiones) && ($this->filtro_regiones->filtrar($dato['region_nombre']) == TRUE))) {
                    $a[] = $dato;
                }
            }
            // Definir la propiedad listado, ahora con sólo datos permitidos
            $this->listado = $a;
        }
    } // consultar

    /**
     * Formatear
     */
    public function formatear() {
        // Validar que se haya consultado
        if (!is_array($this->listado)) {
            throw new \Exception("Error en IndicadorDatosOtrasRegiones, formatear: No ha ejecutado la consulta.");
        }
        // Variables
        $conteo               = 0;
        $conteo_por_tipo_dato = array('cantidad' => 0, 'decimal' => 0, 'dinero' => 0, 'porcentaje' => 0, 'caracter' => 0, 'nd' => 0);
        $cantidad_decimales   = 0;
        $hoy                  = date('Y-m-d');
        // Acumularemos los renglones en este arreglo
        $renglones = array();
        // Bucle en listado
        foreach ($this->listado as $d) {
            // Saltar si este dato es una proyección, o sea, su fecha está en el futuro
            if (strcmp($d['fecha'], $hoy) >= 0) {
                continue;
            }
            // Columna fecha
            $fecha = new Celda($d['fecha']);
            $fecha->formatear_fecha();
            // Determinar la columna con el valor
            if ($d['cantidad'] != '') {
                $dato  = $d['cantidad'];
                $valor = new Celda($dato);
                $valor->formatear_cantidad();
                $conteo_por_tipo_dato['cantidad']++;
            } elseif ($d['decimal'] != '') {
                $dato  = $d['decimal'];
                $valor = new Celda($dato);
                $valor->formatear_decimal();
                if ($valor->contar_decimales() > $cantidad_decimales) {
                    $cantidad_decimales = $valor->contar_decimales();
                }
                $conteo_por_tipo_dato['decimal']++;
            } elseif ($d['dinero'] != '') {
                $dato  = $d['dinero'];
                $valor = new Celda($dato);
                $valor->formatear_dinero();
                $conteo_por_tipo_dato['dinero']++;
            } elseif ($d['porcentaje'] != '') {
                $dato  = $d['porcentaje'];
                $valor = new Celda($dato);
                $valor->formatear_porcentaje();
                if ($valor->contar_decimales() > $cantidad_decimales) {
                    $cantidad_decimales = $valor->contar_decimales();
                }
                $conteo_por_tipo_dato['porcentaje']++;
            } elseif ($d['caracter'] != '') {
                $dato  = $d['caracter'];
                $valor = new Celda($dato);
                $valor->formatear_caracter(\IndIndicadoresDatos\Registro::$caracter_descripciones);
                $conteo_por_tipo_dato['caracter']++;
            } else {
                $dato  = 'ND';
                $valor = new Celda($dato);
                $conteo_por_tipo_dato['nd']++;
            }
            // La clave del arreglo asociativo servirá para ordenarla
            $clave = sprintf('%03s-%s-%12s', $d['region_nivel'], $d['fecha'], $d['id']);
            // Acumular
            $renglones[$clave] = array(
                'region'        => $d['region'],
                'region_nombre' => $d['region_nombre'],
                'fecha'         => $fecha,
                'dato'          => $dato,
                'valor'         => $valor,
                'fuente_nombre' => $d['fuente_nombre'],
                'notas'         => $d['notas']);
            // Incrementar contador
            $conteo++;
        }
        // Podría NO haber datos, porque todos sean de la misma región a comparar
        if ($conteo == 0) {
            throw new \Base2\ListadoExceptionVacio('Aviso en IndicadorDatosOtrasRegiones, formatear: No hay datos para la comparación. Todos son de una región.');
        }
        // Ordenar por la clave, será del más antiguo al más viejo
        ksort($renglones);
        // Segundo bucle, quedarse solo con los renglones más recientes
        $segundo = array();
        foreach ($renglones as $clave => $a) {
            if (!isset($actual)) {
                $actual = $a;
            } elseif ($a['region'] !== $actual['region']) {
                $segundo[] = $actual;
                $actual    = $a;
            } elseif (strcmp($a['fecha']->valor, $actual['fecha']->valor) >= 0) {
                $actual = $a;
            }
        }
        if (end($segundo) !== $a) {
            $segundo[] = $actual;
        }
        // Tercer bucle, para continuar si es que aparece la región en comparativa junto con otras
        $si_esta_region    = FALSE;
        $si_otras_regiones = FALSE;
        foreach ($segundo as $a) {
            if ($a['region'] == $this->region_comparar) {
                $si_esta_region = TRUE;
            }
            if ($a['region'] != $this->region_comparar) {
                $si_otras_regiones = TRUE;
            }
        }
        if (!$si_esta_region) {
            throw new \Base2\ListadoExceptionVacio('Aviso en IndicadorDatosOtrasRegiones, formatear: No hay datos de la región a comparar; sólo de otras.');
        }
        if (!$si_otras_regiones) {
            throw new \Base2\ListadoExceptionVacio('Aviso en IndicadorDatosOtrasRegiones, formatear: No hay datos de otras regiones; sólo de la región a comparar.');
        }
        // Definir propiedad panal
        $this->panal = $segundo;
        // Determinar el formato de la columna valor
        $formato = '';
        foreach ($conteo_por_tipo_dato as $f => $c) {
            if ($c == $conteo) {
                $formato = $f;
            }
        }
        if ($formato == '') {
            $formato = 'texto';
        }
        $this->estructura['valor']['formato'] = $formato;
        // Determinar el ancho (y la cantidad de decimales si lo necesita) de la columna valor
        switch ($formato) {
            case 'cantidad':
                $this->estructura['valor']['ancho'] = 16;
                break;
            case 'decimal':
                $this->estructura['valor']['ancho']              = 24;
                $this->estructura['valor']['cantidad_decimales'] = $cantidad_decimales;
                break;
            case 'dinero':
                $this->estructura['valor']['ancho'] = 24;
                break;
            case 'porcentaje':
                $this->estructura['valor']['ancho']              = 12;
                $this->estructura['valor']['cantidad_decimales'] = $cantidad_decimales;
                break;
            case 'caracter':
                $this->estructura['valor']['ancho'] = 24;
                break;
            case 'nd':
            default:
                $this->estructura['valor']['ancho'] = 12;
        }
    } // formatear

} // Clase IndicadorDatosOtrasRegionesListado

?>
