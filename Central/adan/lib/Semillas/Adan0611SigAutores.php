<?php
/**
 * TrcIMPLAN Central | SIG Autores
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
 * Clase Adan0611SigAutores
 */
class Adan0611SigAutores extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'SigAutores';

    // Nombre de la tabla
    public $tabla_nombre = 'sig_autores';

    // Datos de la tabla
    public $tabla = array(
        'id'           => array('tipo' => 'serial'),

        'nombre'       => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'puesto'       => array('tipo' => 'nombre',   'etiqueta' => 'Puesto',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 12),
        'departamento' => array('tipo' => 'nombre',   'etiqueta' => 'Departamento', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 13),

        'estatus'      => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Autor',
        'etiqueta_plural'    => 'Autores',
        'nom_corto_singular' => 'autor',
        'nom_corto_plural'   => 'autores',
        'mensaje_singular'   => 'el autor',
        'mensaje_plural'     => 'los autores',
        'clave'              => 'sig_autores',
        'clase_singular'     => 'SigAutor',
        'clase_plural'       => 'SigAutores',
        'instancia_singular' => 'autor',
        'instancia_plural'   => 'autores',
        'archivo_singular'   => 'sigautor',
        'archivo_plural'     => 'sigautores',
        'tabla'              => 'sig_autores',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Autor', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['mapas']     = $serpiente->obtener_datos_del_modulo('SigMapas');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0611SigAutores

?>
