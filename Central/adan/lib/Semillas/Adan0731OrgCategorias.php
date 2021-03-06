<?php
/**
 * TrcIMPLAN Central | Organizador Categorías
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
 * Clase Adan0731OrgCategorias
 */
class Adan0731OrgCategorias extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'OrgCategorias';

    // Nombre de la tabla
    public $tabla_nombre = 'org_categorias';

    // Datos de la tabla
    public $tabla = array(
        'id'            => array('tipo' => 'serial'),

        'nombre'        => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'imagen'        => array('tipo' => 'frase',    'etiqueta' => 'Imagen',        'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'imagen_previa' => array('tipo' => 'frase',    'etiqueta' => 'Imagen previa', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'css_id'        => array('tipo' => 'nombre',   'etiqueta' => 'CSS ID',        'validacion' => 1, 'agregar' => 1, 'modificar' => 1),

        'estatus'       => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Categoría',
        'etiqueta_plural'    => 'Categorías',
        'nom_corto_singular' => 'categoría',
        'nom_corto_plural'   => 'categorías',
        'mensaje_singular'   => 'la categoría',
        'mensaje_plural'     => 'las categorías',
        'clave'              => 'org_categorias',
        'clase_singular'     => 'OrgCategoria',
        'clase_plural'       => 'OrgCategorias',
        'instancia_singular' => 'categoria',
        'instancia_plural'   => 'categorias',
        'archivo_singular'   => 'orgcategoria',
        'archivo_plural'     => 'orgcategorias',
        'tabla'              => 'org_categorias',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Categoría', 'filtro' => 1))
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
        $this->hijos['elementos'] = $serpiente->obtener_datos_del_modulo('OrgElementos');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0731OrgCategorias

?>
