<?php
/**
 * TrcIMPLAN Central | Indicadores Subíndices
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
 * Clase Adan0151IndSubindices
 */
class Adan0151IndSubindices extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'IndSubindices';

    // Nombre de la tabla
    public $tabla_nombre = 'ind_subindices';

    // Datos de la tabla
    public $tabla = array(
        'id'          => array('tipo' => 'serial'),

        'nom_corto'   => array('tipo' => 'nom_corto', 'etiqueta' => 'Nom. corto', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'nombre'      => array('tipo' => 'nombre',    'etiqueta' => 'Nombre',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21,               'vip' => 1),

        'notas'       => array('tipo' => 'notas',     'etiqueta' => 'Notas',      'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'     => array('tipo' => 'caracter',  'etiqueta' => 'Estatus',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Subíndice',
        'etiqueta_plural'    => 'Subíndices',
        'nom_corto_singular' => 'subíndice',
        'nom_corto_plural'   => 'subíndices',
        'mensaje_singular'   => 'el subíndice',
        'mensaje_plural'     => 'los subíndices',
        'clave'              => 'ind_subindices',
        'clase_singular'     => 'IndSubindice',
        'clase_plural'       => 'IndSubindices',
        'instancia_singular' => 'subindice',
        'instancia_plural'   => 'subindices',
        'archivo_singular'   => 'indsubindice',
        'archivo_plural'     => 'indsubindices',
        'tabla'              => 'ind_subindices',
        'vip'                => array(
            'nom_corto' => array('tipo' => 'nom_corto', 'etiqueta' => 'Subíndice', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_sin_busqueda();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
    //~ $this->hijos['pesos']       = $serpiente->obtener_datos_del_modulo('IndSubindicesPesos');
        $this->hijos['indicadores'] = $serpiente->obtener_datos_del_modulo('IndIndicadores');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones        = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular   = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus              = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0151IndSubindices

?>
