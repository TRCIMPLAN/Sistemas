<?php
/**
 * TrcIMPLAN Central | Catálogos Regiones
 *
 * Copyright (C) 2017 Guillermo Valdes Lozano guillermo@movimientolibre.com
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
 * @package TrcIMPLAN
 */

namespace Semillas;

/**
 * Clase Adan0135CatRegiones
 */
class Adan0135CatRegiones extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'CatRegiones';

    // Nombre de la tabla
    public $tabla_nombre = 'cat_regiones';

    // Datos de la tabla
    public $tabla = array(
        'id'                => array('tipo' => 'serial'),

        'nivel'             => array('tipo' => 'entero',   'etiqueta' => 'Nivel',             'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 11, 'orden' => 1, 'vip' => 1),
        'nombre'            => array('tipo' => 'nombre',   'etiqueta' => 'Región',            'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21,               'vip' => 2),

        'esquema_pais'      => array('tipo' => 'nombre',   'etiqueta' => 'Esquema país',      'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'esquema_region'    => array('tipo' => 'nombre',   'etiqueta' => 'Esquema región',    'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'esquema_localidad' => array('tipo' => 'nombre',   'etiqueta' => 'Esquema localidad', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1),

        'notas'             => array('tipo' => 'notas',    'etiqueta' => 'Notas',             'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'           => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Región',
        'etiqueta_plural'    => 'Regiones',
        'nom_corto_singular' => 'región',
        'nom_corto_plural'   => 'regiones',
        'mensaje_singular'   => 'la región',
        'mensaje_plural'     => 'las regiones',
        'clave'              => 'cat_regiones',
        'clase_singular'     => 'CatRegion',
        'clase_plural'       => 'CatRegiones',
        'instancia_singular' => 'region',
        'instancia_plural'   => 'regiones',
        'archivo_singular'   => 'catregion',
        'archivo_plural'     => 'catregiones',
        'tabla'              => 'cat_regiones',
        'vip'                => array(
            'nivel'  => array('tipo' => 'entero', 'etiqueta' => 'Nivel',  'filtro' => 1),
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Región', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_sin_busqueda();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0135CatRegiones

?>
