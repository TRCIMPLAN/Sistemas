<?php
/**
 * TrcIMPLAN Central | SIG Imprentas
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
 * Clase Adan0621SigImprentas
 */
class Adan0621SigImprentas extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'SigImprentas';

    // Nombre de la tabla
    public $tabla_nombre = 'sig_imprentas';

    // Datos de la tabla
    public $tabla = array(
        'id'                       => array('tipo' => 'serial'),

        'nombre'                   => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',             'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'nombre_menu'              => array('tipo' => 'frase',    'etiqueta' => 'Menú',               'validacion' => 2, 'agregar' => 1, 'modificar' => 1),
        'directorio'               => array('tipo' => 'frase',    'etiqueta' => 'Dir. sin región',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1,                'listado' => 12),
        'publicaciones_directorio' => array('tipo' => 'nombre',   'etiqueta' => 'Publicaciones dir.', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1,                'listado' => 13),
        'encabezado_color'         => array('tipo' => 'frase',    'etiqueta' => 'Encabezado color',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1),

        'estatus'                  => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',            'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Imprenta',
        'etiqueta_plural'    => 'Imprentas',
        'nom_corto_singular' => 'imprenta',
        'nom_corto_plural'   => 'imprentas',
        'mensaje_singular'   => 'la imprenta',
        'mensaje_plural'     => 'las imprentas',
        'clave'              => 'sig_imprentas',
        'clase_singular'     => 'SigImprenta',
        'clase_plural'       => 'SigImprentas',
        'instancia_singular' => 'imprenta',
        'instancia_plural'   => 'imprentas',
        'archivo_singular'   => 'sigimprenta',
        'archivo_plural'     => 'sigimprentas',
        'tabla'              => 'sig_imprentas',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Imprenta', 'filtro' => 1))
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
        $this->hijos['mapas']     = $serpiente->obtener_datos_del_modulo('SigMapas');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0621SigImprentas

?>
