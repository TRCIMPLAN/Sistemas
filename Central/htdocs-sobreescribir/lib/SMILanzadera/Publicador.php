<?php
/**
 * TrcIMPLAN Central - SMILanzadera Publicador
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
 * Clase Abstracta Publicador
 *
 * Base común con herramientas para crear directorios y archivos en la plataforma web
 */
abstract class Publicador {

    public $mensajes = array();                              // Arreglo con mensajes para la terminal
    protected $sesion;                                       // Instancia de Sesion
//~ protected $sitio_web_directorio = 'beta';                // Acceso directo a la raiz del sitio web
    protected $sitio_web_directorio = 'trcimplan.github.io'; // Acceso directo a la raiz del sitio web
    protected $filtro_categorias;                            // Instancia de FiltroCategorias
    protected $filtro_fuentes;                               // Instancia de FiltroFuentes
    protected $filtro_regiones;                              // Instancia de FiltroRegiones

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // contructor

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
     * Validar directorio sitio web
     */
    protected function validar_directorio_sitio_web() {
        if (!is_dir($this->sitio_web_directorio)) {
            throw new \Exception("Error en Publicador: No existe el directorio del sitio web {$this->sitio_web_directorio}");
        }
    } // validar_directorio_sitio_web

    /**
     * Eliminar un directorio y sus archivos
     *
     * @param string Ruta al directorio a eliminar
     */
    protected function eliminar_directorio($in_ruta) {
        // Validar parámetro
        if (trim($in_ruta) == '') {
            throw new \Exception("Error en Publicador: Parámetro vacio al eliminar directorio.");
        }
        // Validar que exista el directorio con la raíz del sitio web
        $this->validar_directorio_sitio_web();
        // Determinar directorio
        $dir = sprintf('%s/%s', $this->sitio_web_directorio, $in_ruta);
        // Si existe, lo elimina
        if (is_dir($dir)) {
            array_map('unlink', glob("{$dir}/*"));
            if (rmdir($dir) === false) {
                throw new \Exception("Error en Publicador: No se pudo eliminar el directorio $dir");
            }
        }
    } // eliminar_directorio

    /**
     * Crear directorio
     *
     * @param string Ruta al directorio a crear
     */
    protected function crear_directorio($in_ruta) {
        // Validar parámetro
        if (trim($in_ruta) == '') {
            throw new \Exception("Error en Publicador: Parámetro vacio al crear directorio.");
        }
        // Validar que exista el directorio con la raíz del sitio web
        $this->validar_directorio_sitio_web();
        // Determinar directorio
        $dir = sprintf('%s/%s', $this->sitio_web_directorio, $in_ruta);
        // Si no existe, lo crea
        if (!is_dir($dir)) {
            if (mkdir($dir, 0755, true) === false) {
                throw new \Exception("Error en Publicador: No se pudo crear el directorio $dir");
            }
        }
    } // crear_directorio

    /**
     * Crear archivo
     *
     * @param string Ruta al archivo a crear, si empieza con diagonal, por ejemplo /tmp/.. será una ruta absoluta
     * @param mixed  Texto o arreglo con el contenido
     */
    protected function crear_archivo($in_ruta, $in_contenido) {
        // Validar parámetros
        if (trim($in_ruta) == '') {
            throw new \Exception("Error en Publicador: Parámetro vacío, falta la ruta al crear archivo.");
        }
        if (trim($in_contenido) == '') {
            throw new \Exception("Error en Publicador: Parámetro vacío, falta el contenido al crear archivo.");
        }
        // Validar que exista el directorio con la raíz del sitio web
        $this->validar_directorio_sitio_web();
        // Crear el directorio donde se va depositar
        $ruta_partes = pathinfo($in_ruta);
        $directorio  = $ruta_partes['dirname'];
        $this->crear_directorio($directorio);
        // Escribir archivo
        $archivo   = sprintf('%s/%s', $this->sitio_web_directorio, $in_ruta);
        $apuntador = fopen($archivo, 'w');
        if ($apuntador === false) {
            throw new \Exception("Error en Publicador: No se puede crear el archivo $archivo");
        }
        if (is_string($in_contenido)) {
            fwrite($apuntador, $in_contenido);
        } elseif (is_array($in_contenido)) {
            foreach ($in_contenido as $linea) {
                fwrite($apuntador, $in_contenido);
            }
        }
        fclose($apuntador);
    } // crear_archivo

    /**
     * Publicar
     *
     * @return string Mensajes para la terminal
     */
    abstract public function publicar();

} // Clase Abstracta Publicador

?>
