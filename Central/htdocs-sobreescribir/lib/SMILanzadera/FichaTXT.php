<?php
/**
 * TrcIMPLAN Central - SMILanzadera FichaTXT
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
 * Clase FichaTXT
 */
class FichaTXT extends Ficha {

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

    /**
     * TXT
     *
     * @return string Texto
     */
    public function txt() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaTXT: No se ha consultado.");
        }
        // Definir variables
        $fecha      = \Base2\UtileriasParaFormatos::formato_fecha_hora($this->indicador->creado, 'T'); // Pendiente: más adelante que consulte la fecha de creación de los datos y tome el más reciente
        $archivo    = \Base2\UtileriasParaFormatos::caracteres_para_web($this->indicador->subindice_nom_corto.'-'.$this->indicador->nombre);
        $directorio = 'indicadores-'.\Base2\UtileriasParaFormatos::caracteres_para_web($this->region->nombre);
        // Definir variables claves y categorias
        if ($this->indicador->categorias != '') {
            $claves = "'IMPLAN, {$this->region->nombre}, {$this->indicador->categorias}'";
            $a = explode(',', $this->indicador->categorias);
            $b = array();
            foreach ($a as $c) {
                $b[] = trim($c);
            }
            $categorias = "array('".implode("', '", $b)."')";
        } else {
            $claves     = "'IMPLAN, {$this->region->nombre}'";
            $categorias = "array()";
        }
        // Acumular generalidades
        $a   = array();
        $a[] = 'Título, autor y fecha.';
        $a[] = sprintf('  Nombre:         %s', "{$this->indicador->nombre} en {$this->region->nombre}");
        $a[] = sprintf('  Fecha:          %s', $fecha);
        $a[] = 'Nombre del archivo a crear y las rutas relativas a las imágenes.';
        $a[] = sprintf('  Archivo:        %s', $archivo);
        $a[] = 'La descripción y claves dan información a los buscadores y redes sociales.';
        $a[] = sprintf('  Descripción:    %s', $this->indicador->descripcion);
        $a[] = sprintf('  Palabras clave: %s', $claves);
        $a[] = 'El nombre del directorio en la raíz del sitio donde se escribirá el archivo HTML';
        $a[] = sprintf('  Directorio:     %s', $directorio);
        $a[] = 'Para las publicaciones relacionadas.';
        $a[] = sprintf('  Categorías:     %s', $categorias);
        $a[] = '';
        // Acumular listado de datos
        $tabla             = new ListadoTXT();
        $tabla->estructura = $this->indicador_datos->estructura;
        $tabla->panal      = $this->indicador_datos->panal;
        $a[]               = $tabla->txt();
        // Entregar
        return "\n".implode("\n", $a)."\n";
    } // txt

} // Clase FichaTXT

?>
