<?php
/**
 * TrcIMPLAN Central | Desagregación DagAgebs
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
 * Clase Adan0827DagAgebs
 */
class Adan0827DagAgebs extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagAgebs';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_agebs';

    // Datos de la tabla
    public $tabla = array(
        'id'        => array('tipo' => 'serial'),
        'localidad' => array('tipo' => 'relacion', 'etiqueta' => 'Localidad', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 61),

        'clave'     => array('tipo' => 'clave',    'etiqueta' => 'AGEB',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),

        'estatus'   => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'AGEB',
        'etiqueta_plural'    => 'AGEBs',
        'nom_corto_singular' => 'AGEB',
        'nom_corto_plural'   => 'AGEBs',
        'mensaje_singular'   => 'el AGEB',
        'mensaje_plural'     => 'los AGEBs',
        'clave'              => 'dag_agebs',
        'clase_singular'     => 'DagAgeb',
        'clase_plural'       => 'DagAgebs',
        'instancia_singular' => 'ageb',
        'instancia_plural'   => 'agebs',
        'archivo_singular'   => 'dagageb',
        'archivo_plural'     => 'dagagebs',
        'tabla'              => 'dag_agebs',
        'vip'                => array(
            'clave' => array('tipo' => 'clave', 'etiqueta' => 'AGEB', 'filtro' => 1))
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
        $this->relaciones['entidad']   = $serpiente->obtener_datos_del_modulo('DagEntidades');
        $this->relaciones['municipio'] = $serpiente->obtener_datos_del_modulo('DagMunicipios');
        $this->relaciones['localidad'] = $serpiente->obtener_datos_del_modulo('DagLocalidades');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['localidad']      = $serpiente->obtener_datos_del_modulo('DagLocalidades');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['manzanas']       = $serpiente->obtener_datos_del_modulo('DagManzanas');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0827DagAgebs

?>
