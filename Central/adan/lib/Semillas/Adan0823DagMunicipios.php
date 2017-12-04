<?php
/**
 * TrcIMPLAN Central | Desagregación DagMunicipios
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
 * Clase Adan0823DagMunicipios
 */
class Adan0823DagMunicipios extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagMunicipios';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_municipios';

    // Datos de la tabla
    public $tabla = array(
        'id'      => array('tipo' => 'serial'),
        'entidad' => array('tipo' => 'relacion', 'etiqueta' => 'Entidad', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 61),

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
        'etiqueta_singular'  => 'Municipio',
        'etiqueta_plural'    => 'Municipios',
        'nom_corto_singular' => 'municipio',
        'nom_corto_plural'   => 'municipios',
        'mensaje_singular'   => 'el municipio',
        'mensaje_plural'     => 'los municipios',
        'clave'              => 'dag_municipios',
        'clase_singular'     => 'DagMunicipio',
        'clase_plural'       => 'DagMunicipios',
        'instancia_singular' => 'municipio',
        'instancia_plural'   => 'municipios',
        'archivo_singular'   => 'dagmunicipio',
        'archivo_plural'     => 'dagmunicipios',
        'tabla'              => 'dag_municipios',
        'vip'                => array(
            'clave' => array('tipo' => 'clave', 'etiqueta' => 'Municipio', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        $this->modulo_solo_consulta();
        // Obtener de Serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada módulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['entidad'] = $serpiente->obtener_datos_del_modulo('DagEntidades');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['entidad']      = $serpiente->obtener_datos_del_modulo('DagEntidades');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['localidades']  = $serpiente->obtener_datos_del_modulo('DagLocalidades');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones         = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular    = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus               = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0823DagMunicipios

?>
