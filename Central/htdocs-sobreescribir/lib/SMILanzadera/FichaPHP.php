<?php
/**
 * TrcIMPLAN Central - SMILanzadera FichaPHP
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
 * Clase FichaPHP
 */
class FichaPHP extends Ficha {

    // protected $sesion;
    // protected $consultado;
    // public $region;
    // public $indicador;
    // public $indicador_datos;
    // public $indicador_otras_regiones;
    // public $indicador_mapas_region;
    // public $fuentes;
    // protected $filtro_categorias;
    // protected $filtro_fuentes;
    // protected $filtro_regiones;
    protected $espacio; // Texto con el namespace
    protected $clase;   // Texto con el nombre de la clase

    /**
     * Consultar
     *
     * @param integer ID de la Región
     * @param integer ID del Indicador
     */
    public function consultar($in_region=false, $in_indicador=false) {
        // Ejecutar método en el padre
        parent::consultar($in_region, $in_indicador);
        // Definir propiedades espacio y clase
        $this->espacio = sprintf('SMIIndicadores%s', \Base2\UtileriasParaFormatos::caracteres_para_clase($this->region->nombre));
        $this->clase   = \Base2\UtileriasParaFormatos::caracteres_para_clase("{$this->indicador->subindice_nom_corto} {$this->indicador->nombre}");
    } // consultar

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo con esta publicación
     */
    public function ruta() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Entregar
        return sprintf('lib/%s/%s.php', $this->espacio, $this->clase);
    } // ruta

    /**
     * Datos Estructura PHP
     *
     * Contruye la definición del arreglo asociativo con la estructura
     * Este código PHP se pondrá dentro del método datos_estructura
     *
     * @return string Código PHP
     */
    private function datos_estructura_php() {
        // Iniciar arreglo para acumular
        $e = array();
        // Aramar el arreglo con lo que da la propiedad estructura de IndicadorDatosRegionListado
        foreach ($this->indicador_datos->estructura as $columna => $param) {
            $enca    = $param['enca'];
            $formato = $param['formato'];
            $e[]     = sprintf("'%s' => array('enca' => '%s', 'formato' => '%s')", $columna, $enca, $formato);
        }
        // Entregar
        return sprintf("        return array(\n            %s);", implode(",\n            ", $e));
    } // datos_estructura_php

    /**
     * Datos PHP
     *
     * Contruye la definición del arreglo asociativo con los datos
     * Este código PHP se pondrá dentro del método datos
     *
     * @return string Código PHP
     */
    private function datos_php() {
        // Iniciar arreglo para acumular
        $r = array();
        // Armar
        foreach ($this->indicador_datos->panal as $renglon) {
            $a = array();
            foreach ($this->indicador_datos->estructura as $columna => $param) {
                if (($renglon[$columna] instanceof Celda) && ($renglon[$columna]->valor != '')) {
                    $a[] = sprintf("'%s' => '%s'", $columna, $renglon[$columna]->valor);
                } elseif ($renglon[$columna] != '') {
                    $a[] = sprintf("'%s' => '%s'", $columna, $renglon[$columna]);
                }
            }
            $r[] = sprintf("array(%s)", implode(', ', $a));
        }
        // Entregar
        return sprintf("        return array(\n            %s);", implode(",\n            ", $r));
    } // datos_php

    /**
     * Otras Regiones Estructura PHP
     *
     * Contruye la definición del arreglo asociativo con la estructura
     * Este código PHP se pondrá dentro del método otras_regiones_estructura
     *
     * @return string Código PHP
     */
    private function otras_regiones_estructura_php() {
        // La propiedad puede ser FALSO
        if (is_object($this->indicador_otras_regiones)) {
            // Iniciar arreglo para acumular
            $e = array();
            // Aramar el arreglo con lo que da la propiedad estructura de IndicadorDatosOtrasRegiones
            foreach ($this->indicador_otras_regiones->estructura as $columna => $param) {
                $enca    = $param['enca'];
                $formato = $param['formato'];
                $e[]     = sprintf("'%s' => array('enca' => '%s', 'formato' => '%s')", $columna, $enca, $formato);
            }
            // Entregar
            return sprintf("        return array(\n            %s);", implode(",\n            ", $e));
        } else {
            return "        return NULL;";
        }
    } // otras_regiones_estructura_php

    /**
     * Otras regiones PHP
     *
     * Contruye la definición del arreglo asociativo con los datos de otras regiones
     * Este código PHP lo pondrá en el método otras_regiones
     *
     * @return string Código PHP
     */
    private function otras_regiones_php() {
        // La propiedad puede ser FALSO
        if (is_object($this->indicador_otras_regiones)) {
            // Iniciar arreglo para acumular
            $r = array();
            // Armar
            foreach ($this->indicador_otras_regiones->panal as $renglon) {
                $a = array();
                foreach ($this->indicador_otras_regiones->estructura as $columna => $param) {
                    if (($renglon[$columna] instanceof Celda) && ($renglon[$columna]->valor != '')) {
                        $a[] = sprintf("'%s' => '%s'", $columna, $renglon[$columna]->valor);
                    } elseif ($renglon[$columna] != '') {
                        $a[] = sprintf("'%s' => '%s'", $columna, $renglon[$columna]);
                    }
                }
                $r[] = sprintf("array(%s)", implode(', ', $a));
            }
            // Entregar
            return sprintf("        return array(\n            %s);", implode(",\n            ", $r));
        } else {
            return "        return NULL;";
        }
    } // otras_regiones_php

    /**
     * Mapas PHP
     *
     * @return string Mapa PHP
     */
    private function mapas_php() {
        if (is_object($this->indicador_mapas_region)) {
            // Obtener el primer mapa del listado, que es el más reciente
            $a = current($this->indicador_mapas_region->listado); // id, indicador, indicador_nombre, region, region_nivel, region_nombre, fecha, html, notas, estatus
            // Entregar
            return "        return <<<MAPAS_FINAL\n{$a['html']}\nMAPAS_FINAL;";
        } else {
            return "        return NULL;";
        }
    } // mapas_php

    /**
     * Observaciones PHP
     *
     * Este código PHP lo pondrá en el método observaciones
     *
     * @return string Código PHP
     */
    private function observaciones_php() {
        if ($this->indicador->notas != '') {
            return "        return <<<OBSERVACIONES_FINAL\n{$this->indicador->notas}\nOBSERVACIONES_FINAL;";
        } else {
            return "        return NULL;";
        }
    } // observaciones_php

    /**
     * PHP
     *
     * @return string Código PHP
     */
    public function php() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Definir fecha y archivo
        $fecha   = \Base2\UtileriasParaFormatos::formato_fecha_hora($this->indicador->creado, 'T');
        $archivo = sprintf('%s-%s', \Base2\UtileriasParaFormatos::caracteres_para_web($this->indicador->subindice_nom_corto), \Base2\UtileriasParaFormatos::caracteres_para_web($this->indicador->nombre));
        // Definir claves y categorías
        if ($this->indicador->categorias != '') {
            $claves = "IMPLAN, {$this->region->nombre}, {$this->indicador->categorias}";
            $a = explode(',', $this->indicador->categorias);
            $b = array();
            foreach ($a as $c) {
                $b[] = trim($c);
            }
            $categorias = "array('".implode("', '", $b)."')";
        } else {
            $claves     = "IMPLAN, {$this->region->nombre}";
            $categorias = "array()";
        }
        // Definir fuentes
        $fuentes_sin_repetir = array();
        foreach ($this->indicador_datos->listado as $d) {
            $fuentes_sin_repetir[$d['fuente']] = $d['fuente_nombre'];
        }
        $fuentes = "array('".implode("', '", $fuentes_sin_repetir)."')";
        // Definir regiones
        $regiones = "array('{$this->region->nombre}')";
        // Entregar
        return <<<TERMINO
<?php
/**
 * TrcIMPLAN Sitio Web - {$this->espacio} {$this->clase}
 *
 * Copyright (C) 2017 Guillermo Valdés Lozano <guivaloz@movimientolibre.com>
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
 * @package TrcIMPLANSitioWeb
 */

namespace {$this->espacio};

/**
 * Clase {$this->clase}
 */
class {$this->clase} extends \\SMIBase\\PublicacionWeb {

    /**
     * Constructor
     */
    public function __construct() {
        // Ejecutar constructor en el padre
        parent::__construct();
        // Título y fecha
        \$this->nombre      = '{$this->encabezado()}';
        \$this->fecha       = '$fecha';
        // El nombre del archivo a crear
        \$this->archivo     = '$archivo';
        // La descripción y claves dan información a los buscadores y redes sociales
        \$this->descripcion = '{$this->indicador->descripcion}';
        \$this->claves      = '$claves';
        // Para el Organizador
        \$this->categorias  = $categorias;
        \$this->fuentes     = $fuentes;
        \$this->regiones    = $regiones;
    } // constructor

    /**
     * Datos Estructura
     *
     * @return array Arreglo con arreglos asociativos
     */
    public function datos_estructura() {
{$this->datos_estructura_php()}
    } // datos_estructura

    /**
     * Datos
     *
     * @return array Arreglo con arreglos asociativos
     */
    public function datos() {
{$this->datos_php()}
    } // datos

    /**
     * Otras Regiones Estructura
     *
     * @return array Arreglo con arreglos asociativos
     */
    public function otras_regiones_estructura() {
{$this->otras_regiones_estructura_php()}
    } // otras_regiones_estructura

    /**
     * Otras regiones
     *
     * @return array Arreglo con arreglos asociativos
     */
    public function otras_regiones() {
{$this->otras_regiones_php()}
    } // otras_regiones

    /**
     * Mapas
     *
     * @return string Código HTML con el iframe de Carto
     */
    public function mapas() {
{$this->mapas_php()}
    } // mapas

    /**
     * Observaciones
     *
     * @return string Markdown
     */
    public function observaciones() {
{$this->observaciones_php()}
    } // observaciones

} // Clase {$this->clase}

?>

TERMINO;
    } // php

} // FichaPHP

?>
