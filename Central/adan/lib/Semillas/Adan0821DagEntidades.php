<?php
/**
 * TrcIMPLAN Central | Desagregación DagEntidades
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
 * Clase Adan0821DagEntidades
 */
class Adan0821DagEntidades extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagEntidades';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_entidades';

    // Datos de la tabla
    public $tabla = array(
        'id'      => array('tipo' => 'serial'),

        'clave'   => array('tipo' => 'clave',    'etiqueta' => 'Clave',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'nombre'  => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',  'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 12),

        'estatus' => array('tipo' => 'caracter', 'etiqueta' => 'Estatus', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Entidad',
        'etiqueta_plural'    => 'Entidades',
        'nom_corto_singular' => 'entidad',
        'nom_corto_plural'   => 'entidades',
        'mensaje_singular'   => 'la entidad',
        'mensaje_plural'     => 'las entidades',
        'clave'              => 'dag_entidades',
        'clase_singular'     => 'DagEntidad',
        'clase_plural'       => 'DagEntidades',
        'instancia_singular' => 'entidad',
        'instancia_plural'   => 'entidades',
        'archivo_singular'   => 'dagentidad',
        'archivo_plural'     => 'dagentidades',
        'tabla'              => 'dag_entidades',
        'vip'                => array(
            'clave' => array('tipo' => 'clave', 'etiqueta' => 'Entidad', 'filtro' => 1))
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
        $this->hijos['municipios'] = $serpiente->obtener_datos_del_modulo('DagMunicipios');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones       = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular  = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus             = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0821DagEntidades

?>
