<?php
/**
 * TrcIMPLAN Central - IBCLanzadera FichaPHP
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

namespace IBCLanzadera;

/**
 * Clase FichaPHP
 *
 * Toma los datos del conglomerado y le da forma en código PHP
 */
class FichaPHP extends Ficha {

    // protected $sesion;
    // protected $consultado;
    // protected $catalogos;
    // protected $conglomerado;
    // protected $procesados;
    // protected $fecha;
    public $espacio;  // Debe definir el namespace
    protected $clase; // Texto con el nombre de la clase

    /**
     * Consultar
     *
     * @param integer ID del Conglomerado
     */
    public function consultar($in_conglomerado_id=false) {
        // Ejecutar método en el padre
        parent::consultar($in_conglomerado_id);
        // Verificar que esté definido el espacio
        if (!\Base2\UtileriasParaValidar::validar_clase($this->espacio)) {
            throw new \Exception("Error en FichaPHP: No se ha definido la propiedad espacio.");
        }
        // Definir clase
        $this->clase = $this->conglomerado->nom_corto;
    } // consultar

    /**
     * Datos PHP
     *
     * Contruye la definición del arreglo asociativo con los datos
     * Recuerde que la parte IBC de Central sólo se hace cargo de preparar los datos
     * Y que es la Plataforma la que elaborará las gráficas y tablas
     * Este código PHP lo pondrá en el método datos
     *
     * @return string Código PHP
     */
    private function datos_php() {
        $ejes       = array();
        $eje_nombre = '';
        foreach ($this->catalogos->listado as $c) {
            if ($eje_nombre === '') {
                $eje_nombre  = $c['eje_nombre'];
                $indicadores = array();
            }
            if ($c['eje_nombre'] != $eje_nombre) {
                if (count($indicadores) > 0) {
                    $fechas = sprintf("        '%s' => array(\n", Ficha::FECHA).
                        "            ".implode(",\n            ", $indicadores)."\n".
                        "                )";
                    $ejes[] = sprintf("    '%s' => array(\n", $eje_nombre).
                        "        $fechas\n".
                        "            )";
                }
                $eje_nombre  = $c['eje_nombre'];
                $indicadores = array();
            }
            if (array_key_exists($c['nivel'], $this->procesados)) {
                $dato = $this->procesados[$c['nivel']];
                switch ($dato->obtener_formato()) {
                    case 'entero':
                    case 'flotante':
                    case 'dinero':
                    case 'porcentaje':
                        $indicadores[] = sprintf("        '%s' => %s", $c['nombre'], $dato->obtener_valor());
                        break;
                    case 'caracter':
                    case 'texto':
                        $indicadores[] = sprintf("        '%s' => '%s'", $c['nombre'], $dato->obtener_valor());
                        break;
                    default:
                        $indicadores[] = sprintf("        '%s' => \"%s\"", $c['nombre'], $dato->obtener_valor());
                }
            }
        }
        if (count($indicadores) > 0) {
            $fechas = sprintf("        '%s' => array(\n", Ficha::FECHA).
                "            ".implode(",\n            ", $indicadores)."\n".
                "                )";
            $ejes[] = sprintf("    '%s' => array(\n", $eje_nombre).
                "        $fechas\n".
                "            )";
        }
        if (count($ejes) > 0) {
            return "        return array(\n".
                "        ".implode(",\n        ", $ejes)."\n".
                "        );";
        } else {
            return "        return array();";
        }
    } // datos_php

    /**
     * Mapas PHP
     *
     * Contruye la definición del arreglo asociativo con los datos para los mapas
     * Este código PHP lo pondrá en el método mapas
     *
     * @return string Código PHP
     */
    private function mapas_php() {
        $a   = array();
        $a[] = "'Límites'         => \\Configuracion\\IBCTorreonConfig::LIMITES";
        $a[] = "'Centro latitud'  => {$this->conglomerado->centro_latitud}";
        $a[] = "'Centro longitud' => {$this->conglomerado->centro_longitud}";
        return "        return array(\n".
            "            ".implode(",\n            ", $a)."\n".
            "        );";
    } // mapas_php

    /**
     * Resena PHP
     *
     * Construye la definición para la reseña
     *
     * @return string Código PHP
     */
    private function resena_php() {
        if ($this->conglomerado->notas != '') {
            return <<<RESENA
        return <<<FINAL
{$this->conglomerado->notas}
FINAL;
RESENA;
        } else {
            return "        return '';";
        }
    } // resena_php

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo con esta publicación
     */
    public function ruta() {
        // Si NO se ha consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Entregar
        return sprintf('lib/%s/%s.php', $this->espacio, $this->clase);
    } // ruta

    /**
     * PHP
     *
     * @return string Código PHP
     */
    public function php() {
        // Si NO se ha consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Definir variables
        $fecha       = \Base2\UtileriasParaFormatos::formato_fecha_hora($this->conglomerado->modificado, 'T');
        $archivo     = \Base2\UtileriasParaFormatos::caracteres_para_web($this->conglomerado->nombre);
        $descripcion = sprintf('Colonia %s en Torreón, Coahuila de Zaragoza, México.', $this->conglomerado->nombre);
        $claves      = "IMPLAN, Torreon, Indicadores, Colonia, {$this->conglomerado->nombre}";
        // Entregar
        return <<<CONTENIDO
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
class {$this->clase} extends \\IBCBase\\PublicacionWeb {

    /**
     * Constructor
     */
    public function __construct() {
        // Ejecutar constructor en el padre
        parent::__construct();
        // Título, autor y fecha
        \$this->nombre      = '{$this->conglomerado->nombre}';
        \$this->fecha       = '$fecha';
        // El nombre del archivo a crear
        \$this->archivo     = '$archivo';
        // La descripción y claves dan información a los buscadores y redes sociales
        \$this->descripcion = '$descripcion';
        \$this->claves      = '$claves';
    } // constructor

    /**
     * Datos
     *
     * @return array Arreglo asociativo
     */
    public function datos() {
{$this->datos_php()}
    } // datos

    /**
     * Mapas
     *
     * @return string
     */
    public function mapas() {
{$this->mapas_php()}
    } // mapas

    /**
     * Reseña
     *
     * @return string
     */
    public function resena() {
{$this->resena_php()}
    } // resena

} // Clase {$this->clase}

?>

CONTENIDO;
    } // php

} // Clase FichaPHP

?>
