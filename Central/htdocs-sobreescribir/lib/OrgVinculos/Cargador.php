<?php
/**
 * TrcIMPLAN Central - OrgVinculos Cargador
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
 * Clase Cargador
 */
class Cargador extends Registro {

    // protected $sesion;
    // protected $consultado;
    // public $id;
    // public $rama;
    // public $rama_nom_corto;
    // public $nivel;
    // public $fecha;
    // public $nombre;
    // public $archivo;
    // public $imagen;
    // public $imagen_previa;
    // public $descripcion;
    // public $estado;
    // public $estado_descrito;
    // public $para_compartir;
    // public $para_compartir_descrito;
    // public $url;
    // public $estatus;
    // public $estatus_descrito;
    // static public $estado_descripciones;
    // static public $estado_colores;
    // static public $para_compartir_descripciones;
    // static public $para_compartir_colores;
    // static public $estatus_descripciones;
    // static public $estatus_colores;
    protected $publicacion;

    /**
     * Cargar
     *
     * @param  string Namespace/Clase
     * @return string Mensaje
     */
    public function cargar($namespace_clase) {
        // Preparar un arreglo asociativo para estado
        $estados_claves = array();
        foreach (parent::$estado_descripciones as $clave => $descripcion) {
            $estados_claves[strtolower($descripcion)] = $clave;
        }
        // Cargar publicación
        $publicacion = new $namespace_clase();
        // Si es una publicación
        if ($publicacion instanceof \Base\Publicacion) {
            // Copiar propiedades
         // $this->rama             Debe definirse desde fuera
            $this->nivel          = 0;
            $this->creado         = $publicacion->fecha;
            $this->nombre         = $publicacion->nombre;
            $this->archivo        = $publicacion->archivo;
            $this->imagen         = $publicacion->imagen;
            $this->imagen_previa  = $publicacion->imagen_previa;
            $this->descripcion    = $publicacion->descripcion;
            $this->estado         = $estados_claves[strtolower($publicacion->estado)];
            $this->para_compartir = ($publicacion->para_compartir) ? 'S' : 'N';
            $this->estatus        = 'A'; // En Uso
            // URL
            $this->url = sprintf('%s/%s/%s.html', 'http://www.trcimplan.gob.mx', $this->directorio, $this->archivo);
            // Definir descritos
            $this->estado_descrito         = parent::$estado_descripciones[$this->estado];
            $this->para_compartir_descrito = parent::$para_compartir_descripciones[$this->para_compartir];
            // Conservar publicación
            $this->publicacion = $publicacion;
        } else {
            throw new CargadorExceptionNoEsPublicacion("Aviso: $namespace_clase no es una publicación.");
        }
        // Entregar mensaje
        return "Se cargó la publicación $namespace_clase.";
    } // cargar

    /**
     * Separar datos
     *
     * @param  mixed Arreglo o cadena de texto con los datos a separar
     * @return array Arreglo con textos ya separados
     */
    protected function separar_datos($crudo) {
        $separado = array();
        if (is_array($crudo) && (count($crudo) > 0)) {
            foreach ($crudo as $c) {
                $separado[] = trim($c);
            }
        } elseif (is_string($crudo) && ($crudo != '')) {
            $arreglo = explode(',', $crudo);
            foreach ($arreglo as $c) {
                $separado[] = trim($c);
            }
        }
        return $separado;
    } // separar_datos

    /**
     * Obtener autores
     *
     * @return array Arreglo con los textos de las categorías
     */
    public function obtener_autores() {
        // Validar que se haya cargado
        if (!is_object($this->publicacion)) {
            throw new \Exception("Error: No ha sido cargada la publicación");
        }
        // Separar autor y entregar
        return $this->separar_datos($this->publicacion->autor);
    } // obtener_autores

    /**
     * Obtener categorias
     *
     * @return array Arreglo con los textos de las categorías
     */
    public function obtener_categorias() {
        // Validar que se haya cargado
        if (!is_object($this->publicacion)) {
            throw new \Exception("Error: No ha sido cargada la publicación");
        }
        // Separar categorias y entregar
        return $this->separar_datos($this->publicacion->categorias);
    } // obtener_categorias

    /**
     * Obtener fuentes
     *
     * @return array Arreglo con los textos de las categorías
     */
    public function obtener_fuentes() {
        // Validar que se haya cargado
        if (!is_object($this->publicacion)) {
            throw new \Exception("Error: No ha sido cargada la publicación");
        }
        // Separar fuentes y entregar
        return $this->separar_datos($this->publicacion->fuentes);
    } // obtener_fuentes

    /**
     * Obtener regiones
     *
     * @return array Arreglo con los textos de las categorías
     */
    public function obtener_regiones() {
        // Validar que se haya cargado
        if (!is_object($this->publicacion)) {
            throw new \Exception("Error: No ha sido cargada la publicación");
        }
        // Separar categorias y entregar
        return $this->separar_datos($this->publicacion->regiones);
    } // obtener_regiones

} // Clase Cargador

?>
