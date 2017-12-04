<?php
/**
 * TrcIMPLAN Central | Indicadores
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
 * Clase Adan0161IndIndicadores
 */
class Adan0161IndIndicadores extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'IndIndicadores';

    // Nombre de la tabla
    public $tabla_nombre = 'ind_indicadores';

    // Datos de la tabla
    public $tabla = array(
        'id'          => array('tipo' => 'serial'),
        'subindice'   => array('tipo' => 'relacion',   'etiqueta' => 'Subíndice',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21,               'vip' => 1),
        'unidad'      => array('tipo' => 'relacion',   'etiqueta' => 'Unidad',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1,                'listado' => 31),

        'nombre'      => array('tipo' => 'nombre',     'etiqueta' => 'Nombre',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'descripcion' => array('tipo' => 'notas',      'etiqueta' => 'Descripción', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'categorias'  => array('tipo' => 'nombre',     'etiqueta' => 'Categorías',  'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 81),

        'importancia' => array('tipo' => 'entero',     'etiqueta' => 'Importancia', 'validacion' => 0, 'agregar' => 1, 'modificar' => 1),

        'notas'       => array('tipo' => 'notas',      'etiqueta' => 'Notas',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'creado'      => array('tipo' => 'fecha_hora', 'etiqueta' => 'Creado'),
        'modificado'  => array('tipo' => 'fecha_hora', 'etiqueta' => 'Modificado',                                                       'filtro' => 2, 'listado' => 91),
        'estatus'     => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Indicador',
        'etiqueta_plural'    => 'Indicadores',
        'nom_corto_singular' => 'indicador',
        'nom_corto_plural'   => 'indicadores',
        'mensaje_singular'   => 'el indicador',
        'mensaje_plural'     => 'los indicadores',
        'clave'              => 'ind_indicadores',
        'clase_singular'     => 'IndIndicador',
        'clase_plural'       => 'IndIndicadores',
        'instancia_singular' => 'indicador',
        'instancia_plural'   => 'indicadores',
        'archivo_singular'   => 'indindicador',
        'archivo_plural'     => 'indindicadores',
        'tabla'              => 'ind_indicadores',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Indicador', 'filtro' => 1))
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
        $this->relaciones['subindice'] = $serpiente->obtener_datos_del_modulo('IndSubindices');
        $this->relaciones['unidad']    = $serpiente->obtener_datos_del_modulo('CatUnidades');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['subindice']      = $serpiente->obtener_datos_del_modulo('IndSubindices');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['datos']          = $serpiente->obtener_datos_del_modulo('IndIndicadoresDatos');
        $this->hijos['mapas']          = $serpiente->obtener_datos_del_modulo('IndIndicadoresMapas');
        // SIEMPRE SE DEBE DE CARGAR DE SERPIENTE ESTA INFORMACION
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0161IndIndicadores

?>
