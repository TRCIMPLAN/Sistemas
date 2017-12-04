<?php
/**
 * TrcIMPLAN Central | Organizador Árboles
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
 * Clase Adan0711OrgArboles
 */
class Adan0711OrgArboles extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'OrgArboles';

    // Nombre de la tabla
    public $tabla_nombre = 'org_arboles';

    // Datos de la tabla
    public $tabla = array(
        'id'        => array('tipo' => 'serial'),

        'nivel'     => array('tipo' => 'entero',   'etiqueta' => 'Nivel',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 21, 'orden' => 1),
        'nom_corto' => array('tipo' => 'nombre',   'etiqueta' => 'Nombre corto', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 22, 'orden' => 2, 'vip' => 2),
        'nombre'    => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 23),

        'estatus'   => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Árbol',
        'etiqueta_plural'    => 'Árboles',
        'nom_corto_singular' => 'árbol',
        'nom_corto_plural'   => 'árboles',
        'mensaje_singular'   => 'el árbol',
        'mensaje_plural'     => 'los árboles',
        'clave'              => 'org_arboles',
        'clase_singular'     => 'OrgArbol',
        'clase_plural'       => 'OrgArboles',
        'instancia_singular' => 'arbol',
        'instancia_plural'   => 'arboles',
        'archivo_singular'   => 'orgarbol',
        'archivo_plural'     => 'orgarboles',
        'tabla'              => 'org_arboles',
        'vip'                => array(
            'nom_corto' => array('tipo' => 'nombre', 'etiqueta' => 'Árbol', 'filtro' => 1))
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
        $this->hijos['ramas']     = $serpiente->obtener_datos_del_modulo('OrgRamas');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0711OrgArboles

?>
