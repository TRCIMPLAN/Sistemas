<?php
/**
 * TrcIMPLAN Central | Proyectos
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
 * Clase Adan0451ProProyectos
 */
class Adan0451ProProyectos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'ProProyectos';

    // Nombre de la tabla
    public $tabla_nombre = 'pro_proyectos';

    // Datos de la tabla
    public $tabla = array(
        'id'          => array('tipo' => 'serial'),
        'responsable' => array('tipo' => 'relacion',   'etiqueta' => 'Responsable', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 51,               'vip' => 1),

        'fecha'       => array('tipo' => 'fecha',      'etiqueta' => 'Fecha',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2,                                'vip' => 1),
        'nombre'      => array('tipo' => 'nombre',     'etiqueta' => 'Proyecto',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),

    //  'creado'      => array('tipo' => 'fecha_hora', 'etiqueta' => 'Creado'),
        'notas'       => array('tipo' => 'notas',      'etiqueta' => 'Notas',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'     => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Proyecto',
        'etiqueta_plural'    => 'Proyectos',
        'nom_corto_singular' => 'proyecto',
        'nom_corto_plural'   => 'proyectos',
        'mensaje_singular'   => 'el proyecto',
        'mensaje_plural'     => 'los proyectos',
        'clave'              => 'pro_proyectos',
        'clase_singular'     => 'ProProyecto',
        'clase_plural'       => 'ProProyectos',
        'instancia_singular' => 'proyecto',
        'instancia_plural'   => 'proyectos',
        'archivo_singular'   => 'proproyecto',
        'archivo_plural'     => 'proproyectos',
        'tabla'              => 'pro_proyectos',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Proyecto', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada modulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['responsable'] = $serpiente->obtener_datos_del_modulo('ProResponsables');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['responsable']      = $serpiente->obtener_datos_del_modulo('ProResponsables');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['calificaciones']   = $serpiente->obtener_datos_del_modulo('ProProyectosCalificaciones');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones             = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular        = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                   = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0451ProProyectos

?>
