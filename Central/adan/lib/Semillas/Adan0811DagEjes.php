<?php
/**
 * TrcIMPLAN Central | Desagregación DagEjes
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
 * Clase Adan0811DagEjes
 */
class Adan0811DagEjes extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagEjes';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_ejes';

    // Datos de la tabla
    public $tabla = array(
        'id'        => array('tipo' => 'serial'),

        'nivel'     => array('tipo' => 'entero',    'etiqueta' => 'Nivel',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 51, 'orden' => 1),
        'nombre'    => array('tipo' => 'nombre',    'etiqueta' => 'Nombre',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 52, 'vip' => 2),
        'nom_corto' => array('tipo' => 'nom_corto', 'etiqueta' => 'Nombre corto', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 53),

        'estatus'   => array('tipo' => 'caracter',  'etiqueta' => 'Estatus',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Eje',
        'etiqueta_plural'    => 'Ejes',
        'nom_corto_singular' => 'eje',
        'nom_corto_plural'   => 'ejes',
        'mensaje_singular'   => 'el eje',
        'mensaje_plural'     => 'los ejes',
        'clave'              => 'dag_ejes',
        'clase_singular'     => 'DagEje',
        'clase_plural'       => 'DagEjes',
        'instancia_singular' => 'eje',
        'instancia_plural'   => 'ejes',
        'archivo_singular'   => 'dageje',
        'archivo_plural'     => 'dagejes',
        'tabla'              => 'dag_ejes',
        'vip'                => array(
            'nombre'    => array('tipo' => 'nombre',    'etiqueta' => 'Eje',          'filtro' => 1),
            'nom_corto' => array('tipo' => 'nom_corto', 'etiqueta' => 'Eje N. Corto', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        $this->modulo_sin_busqueda();
        $this->modulo_solo_consulta();
        // Obtener de Serpiente
        $serpiente = new Serpiente();
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['catalogos'] = $serpiente->obtener_datos_del_modulo('DagCatalogos');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0811DagEjes

?>
