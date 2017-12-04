<?php
/**
 * TrcIMPLAN Central - SMILanzadera IndicadorDatosRegionListado
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
 * Clase IndicadorDatosRegionListado
 *
 * Consultar los datos de un Indicador y de una Región dada.
 * Da formato al dato de acuerdo a su tipo.
 */
class IndicadorDatosRegionListado extends \IndIndicadoresDatos\Listado {

    // protected $sesion;       // Instancia con la sesión
    // public $consultado;      // Bandera
    // public $listado;         // Arreglo donde el método consultar deja la consulta
    // public $panal;           // Arreglo de arreglos con instancias de Celda que formatear armará
    // public $region;          // Entero, ID de la región
    // public $indicador;       // Entero, ID del indicador
    // public $estatus;         // Caracter, 'A' es EN USO, 'B' es ELIMINADO
    public $estructura = array(
        'fecha'         => array('enca' => 'Fecha',  'ancho' => 10, 'formato' => 'fecha'),
        'valor'         => array('enca' => 'Dato',   'ancho' => 24, 'formato' => ''),
        'fuente_nombre' => array('enca' => 'Fuente', 'ancho' => 48, 'formato' => 'texto'),
        'notas'         => array('enca' => 'Notas',  'ancho' => 52, 'formato' => 'texto'));
    protected $filtro_fuentes;  // Instancia de FiltroFuentes

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
     * Validar
     */
    public function validar() {
        // Validar que esté definido el indicador
        if (!\Base2\UtileriasParaValidar::validar_entero($this->indicador)) {
            throw new \Base\ListadoExceptionValidacion("Error en IndicadorDatosRegionListado, validar: No ha definido el indicador.");
        }
        // Validar que esté definida la región
        if (!\Base2\UtileriasParaValidar::validar_entero($this->region)) {
            throw new \Base\ListadoExceptionValidacion("Error en IndicadorDatosRegionListado, validar: No ha definido la región.");
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
        // Si está definido el filtro por fuentes
        if ($this->filtro_fuentes instanceof FiltroFuentes) {
            // Iniciar arreglo donde acumularemos los datos que sí se permitan
            $a = array();
            // Bucle en listado
            foreach ($this->listado as $dato) {
                if ($this->filtro_fuentes->filtrar($dato['fuente_nombre']) == TRUE) {
                    $a[] = $dato;
                }
            }
            // Definir la propiedad listado, ahora con sólo datos permitidos
            $this->listado = $a;
        }
    } // consultar

    /**
     * Formatear Tabla
     */
    public function formatear() {
        // Validar que se haya consultado
        if (!is_array($this->listado)) {
            throw new \Exception("Error en IndicadorDatosRegionListado, formatear: No ha ejecutado la consulta.");
        }
        // Variables
        $conteo               = 0;
        $conteo_por_tipo_dato = array('cantidad' => 0, 'decimal' => 0, 'dinero' => 0, 'porcentaje' => 0, 'caracter' => 0, 'nd' => 0);
        $cantidad_decimales   = 0;
        // Acumularemos los renglones en este arreglo
        $renglones = array();
        // Bucle en listado
        foreach ($this->listado as $d) {
            // Columna fecha
            $fecha = new Celda($d['fecha']);
            $fecha->formatear_fecha();
            // Determinar la columna con el valor
            if ($d['cantidad'] != '') {
                $dato = new Celda($d['cantidad']);
                $dato->formatear_cantidad();
                $conteo_por_tipo_dato['cantidad']++;
            } elseif ($d['decimal'] != '') {
                $dato = new Celda($d['decimal']);
                $dato->formatear_decimal();
                if ($dato->contar_decimales() > $cantidad_decimales) {
                    $cantidad_decimales = $dato->contar_decimales();
                }
                $conteo_por_tipo_dato['decimal']++;
            } elseif ($d['dinero'] != '') {
                $dato = new Celda($d['dinero']);
                $dato->formatear_dinero();
                $conteo_por_tipo_dato['dinero']++;
            } elseif ($d['porcentaje'] != '') {
                $dato = new Celda($d['porcentaje']);
                $dato->formatear_porcentaje();
                if ($dato->contar_decimales() > $cantidad_decimales) {
                    $cantidad_decimales = $dato->contar_decimales();
                }
                $conteo_por_tipo_dato['porcentaje']++;
            } elseif ($d['caracter'] != '') {
                $dato = new Celda($d['caracter']);
                $dato->formatear_caracter(\IndIndicadoresDatos\Registro::$caracter_descripciones);
                $conteo_por_tipo_dato['caracter']++;
            } else {
                $dato = new Celda('ND');
                $conteo_por_tipo_dato['nd']++;
            }
            // La clave del arreglo asociativo servirá para ordenarla
            $clave = sprintf('%s-%010s', $d['fecha'], $d['id']);
            // Acumular
            $renglones[$clave] = array(
                'fecha'         => $fecha,
                'valor'         => $dato,
                'fuente_nombre' => $d['fuente_nombre'],
                'notas'         => $d['notas']);
            // Incrementar contador
            $conteo++;
        }
        // Ordenar por la clave, será del más antiguo al más viejo
        ksort($renglones);
        // Definir propiedad panal
        $this->panal = $renglones;
        // Determinar el formato
        $formato = '';
        foreach ($conteo_por_tipo_dato as $f => $c) {
            if ($c == $conteo) {
                $formato = $f;
            }
        }
        if ($formato != '') {
            $this->estructura['valor']['formato'] = $formato;
        } else {
            $this->estructura['valor']['formato'] = 'texto';
        }
        // Determinar el ancho
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
                $this->estructura['valor']['ancho'] = 8;
        }
    } // formatear

    /**
     * Formato del Valor
     *
     * @return string Formato del valor
     */
    public function valor_formato() {
        // Validar que se haya consultado
        if (!is_array($this->listado)) {
            throw new \Exception("Error en IndicadorDatosRegionListado: No ha ejecutado la consulta.");
        }
        // Entregar
        return $this->estructura['valor']['formato'];
    } // formato_valor

    /**
     * Cantidad
     *
     * @return integer Cantidad de registros
     */
    public function cantidad() {
        // Validar que se haya consultado
        if (!is_array($this->listado)) {
            throw new \Exception("Error en IndicadorDatosRegionListado: No ha ejecutado la consulta.");
        }
        // Entregar
        return count($this->listado);
    } // cantidad

} // Clase IndicadorDatosRegionListado

?>
