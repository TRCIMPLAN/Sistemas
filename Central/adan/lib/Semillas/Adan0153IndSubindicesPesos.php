<?php
/**
 * TrcIMPLAN Central | Indicadores Subíndices Pesos
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
 * Clase Adan0153IndSubindicesPesos
 */
class Adan0153IndSubindicesPesos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'IndSubindicesPesos';

    // Nombre de la tabla
    public $tabla_nombre = 'ind_subindices_pesos';

    // Datos de la tabla
    public $tabla = array(
        'id'        => array('tipo' => 'serial'),
        'subindice' => array('tipo' => 'relacion', 'etiqueta' => 'Subíndice', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 51,               'vip' => 1),

        'nombre'    => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'ano'       => array('tipo' => 'entero',   'etiqueta' => 'Año',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 21),
        'peso'      => array('tipo' => 'flotante', 'etiqueta' => 'Peso',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 31),

        'notas'     => array('tipo' => 'notas',    'etiqueta' => 'Notas',     'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'   => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Peso',
        'etiqueta_plural'    => 'Pesos',
        'nom_corto_singular' => 'peso',
        'nom_corto_plural'   => 'pesos',
        'mensaje_singular'   => 'el peso',
        'mensaje_plural'     => 'los pesos',
        'clave'              => 'ind_subindices_pesos',
        'clase_singular'     => 'IndSubindicePeso',
        'clase_plural'       => 'IndSubindicesPesos',
        'instancia_singular' => 'subindice_peso',
        'instancia_plural'   => 'subindices_pesos',
        'archivo_singular'   => 'indsubindicepeso',
        'archivo_plural'     => 'indsubindicespesos',
        'tabla'              => 'ind_subindices_pesos',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Peso del subíndice', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_sin_busqueda();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada modulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['subindice'] = $serpiente->obtener_datos_del_modulo('IndSubindices');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['subindice']      = $serpiente->obtener_datos_del_modulo('IndSubindices');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0153IndSubindicesPesos

?>
