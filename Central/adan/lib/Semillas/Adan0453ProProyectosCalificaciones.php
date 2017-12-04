<?php
/**
 * TrcIMPLAN Central | Proyectos Calificaciones
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
 * Clase Adan0453ProProyectosCalificaciones
 */
class Adan0453ProProyectosCalificaciones extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'ProProyectosCalificaciones';

    // Nombre de la tabla
    public $tabla_nombre = 'pro_proyectos_calificaciones';

    // Datos de la tabla
    public $tabla = array(
        'id'           => array('tipo' => 'serial'),
        'proyecto'     => array('tipo' => 'relacion',   'etiqueta' => 'Proyecto',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 1),
        'evaluador'    => array('tipo' => 'relacion',   'etiqueta' => 'Evaluador',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21, 'orden' => 2, 'vip' => 1),
        'factor'       => array('tipo' => 'relacion',   'etiqueta' => 'Factor',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 31, 'orden' => 3, 'vip' => 1),

        'calificacion' => array('tipo' => 'entero',     'etiqueta' => 'Calificación', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 51,               'vip' => 2),

    //  'creado'       => array('tipo' => 'fecha_hora', 'etiqueta' => 'Creado'),
        'notas'        => array('tipo' => 'notas',      'etiqueta' => 'Notas',        'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'      => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Calificación',
        'etiqueta_plural'    => 'Calificaciones',
        'nom_corto_singular' => 'calificación',
        'nom_corto_plural'   => 'calificaciones',
        'mensaje_singular'   => 'la calificación',
        'mensaje_plural'     => 'las calificaciones',
        'clave'              => 'pro_proyectos_calificaciones',
        'clase_singular'     => 'ProProyectoCalificacion',
        'clase_plural'       => 'ProProyectosCalificaciones',
        'instancia_singular' => 'proyecto_calificacion',
        'instancia_plural'   => 'proyectos_calificaciones',
        'archivo_singular'   => 'proproyectocalificacion',
        'archivo_plural'     => 'proproyectoscalificaciones',
        'tabla'              => 'pro_proyectos_calificaciones',
        'vip'                => array(
            'proyecto'     => array('tipo' => 'relacion', 'etiqueta' => 'Proyecto',     'filtro' => 1),
            'calificacion' => array('tipo' => 'entero',   'etiqueta' => 'Calificación', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_sin_herederos();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada modulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['responsable'] = $serpiente->obtener_datos_del_modulo('ProResponsables');
        $this->relaciones['evaluador']   = $serpiente->obtener_datos_del_modulo('ProEvaluadores');
        $this->relaciones['proyecto']    = $serpiente->obtener_datos_del_modulo('ProProyectos');
        $this->relaciones['criterio']    = $serpiente->obtener_datos_del_modulo('ProCriterios');
        $this->relaciones['factor']      = $serpiente->obtener_datos_del_modulo('ProFactores');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['proyecto']         = $serpiente->obtener_datos_del_modulo('ProProyectos');
        $this->padre['evaluador']        = $serpiente->obtener_datos_del_modulo('ProEvaluadores');
        $this->padre['factor']           = $serpiente->obtener_datos_del_modulo('ProFactores');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones             = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular        = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                   = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0453ProProyectosCalificaciones

?>
