<?php
/**
 * TrcIMPLAN Central | Proyectos Responsables
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
 * Clase Adan0447ProResponsables
 */
class Adan0447ProResponsables extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'ProResponsables';

    // Nombre de la tabla
    public $tabla_nombre = 'pro_responsables';

    // Datos de la tabla
    public $tabla = array(
        'id'      => array('tipo' => 'serial'),

        'nombre'  => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'tipo'    => array('tipo' => 'caracter', 'etiqueta' => 'Tipo',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 91,               'vip' => 1,
            'descripciones' => array('M' => 'Dirección municipal', 'C' => 'Organización civil', 'O' => 'Otro'),
            'etiquetas'     => array('M' => 'Dirección Municipal', 'C' => 'Organización Civil', 'O' => 'Otro'),
            'colores'       => array('M' => 'amarillo',            'C' => 'rosa',               'O' => 'gris')),

        'notas'   => array('tipo' => 'notas',      'etiqueta' => 'Notas',    'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus' => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',  'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Responsable',
        'etiqueta_plural'    => 'Responsables',
        'nom_corto_singular' => 'responsable',
        'nom_corto_plural'   => 'responsables',
        'mensaje_singular'   => 'el responsable',
        'mensaje_plural'     => 'los responsables',
        'clave'              => 'pro_responsables',
        'clase_singular'     => 'ProResponsable',
        'clase_plural'       => 'ProResponsables',
        'instancia_singular' => 'responsable',
        'instancia_plural'   => 'responsables',
        'archivo_singular'   => 'proresponsable',
        'archivo_plural'     => 'proresponsables',
        'tabla'              => 'pro_responsables',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Responsable', 'filtro' => 1))
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
        $this->hijos['proyectos'] = $serpiente->obtener_datos_del_modulo('ProProyectos');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0447ProResponsables

?>
