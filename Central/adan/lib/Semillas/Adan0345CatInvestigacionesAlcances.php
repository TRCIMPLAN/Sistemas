<?php
/**
 * TrcIMPLAN Central | Catálogos Investigaciones Alcances
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
 * Clase Adan0345CatInvestigacionesAlcances
 */
class Adan0345CatInvestigacionesAlcances extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'CatInvestigacionesAlcances';

    // Nombre de la tabla
    public $tabla_nombre = 'cat_investigaciones_alcances';

    // Datos de la tabla
    public $tabla = array(
        'id'          => array('tipo' => 'serial'),

        'nombre'      => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'descripcion' => array('tipo' => 'nombre',   'etiqueta' => 'Descripción', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21,               'vip' => 1),

        'notas'       => array('tipo' => 'notas',    'etiqueta' => 'Notas',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'     => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Clasificación por el Alcance de la Investigación',
        'etiqueta_plural'    => 'Clasificaciones por los Alcances de las Investigaciones',
        'nom_corto_singular' => 'alcance',
        'nom_corto_plural'   => 'alcances',
        'mensaje_singular'   => 'el alcance de la investigación',
        'mensaje_plural'     => 'los alcances de las investigaciones',
        'clave'              => 'cat_investigaciones_alcances',
        'clase_singular'     => 'CatInvestigacionAlcance',
        'clase_plural'       => 'CatInvestigacionesAlcances',
        'instancia_singular' => 'investigacion_alcance',
        'instancia_plural'   => 'investigaciones_alcances',
        'archivo_singular'   => 'catinvestigacionalcance',
        'archivo_plural'     => 'catinvestigacionesalcances',
        'tabla'              => 'cat_investigaciones_alcances',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Clasif. Alcance', 'filtro' => 1))
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
        $this->hijos['investigaciones'] = $serpiente->obtener_datos_del_modulo('InvInvestigaciones');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones            = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular       = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                  = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0345CatInvestigacionesAlcances

?>
