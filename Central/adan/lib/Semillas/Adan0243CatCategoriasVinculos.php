<?php
/**
 * TrcIMPLAN Central | Catálogos Vínculos
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
 * Clase Adan0243CatCategoriasVinculos
 */
class Adan0243CatCategoriasVinculos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'CatCategoriasVinculos';

    // Nombre de la tabla
    public $tabla_nombre = 'cat_categorias_vinculos';

    // Datos de la tabla
    public $tabla = array(
        'id'            => array('tipo' => 'serial'),
        'categoria'     => array('tipo' => 'relacion',   'etiqueta' => 'Categoría',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 51,               'vip' => 1),

        'nombre'        => array('tipo' => 'frase',      'etiqueta' => 'Título',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'descripcion'   => array('tipo' => 'notas',      'etiqueta' => 'Descripción',   'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'imagen_previa' => array('tipo' => 'frase',      'etiqueta' => 'Imagen previa', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'vinculo'       => array('tipo' => 'frase',      'etiqueta' => 'Vínculo',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1,                'listado' => 13),

        'region_nivel'  => array('tipo' => 'entero',     'etiqueta' => 'Región nivel',  'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 81),
        'tipo'          => array('tipo' => 'caracter',   'etiqueta' => 'Tipo',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 85,
            'descripciones' => array('A' => 'Análisis', 'I' => 'Indicador', 'G' => 'GIS',   'P' => 'Proyecto', 'O' => 'Otro'),
            'etiquetas'     => array('A' => 'Análisis', 'I' => 'Indicador', 'G' => 'GIS',   'P' => 'Proyecto', 'O' => 'Otro'),
            'colores'       => array('A' => 'azul',     'I' => 'amarillo',  'G' => 'verde', 'P' => 'rosa',     'O' => 'gris')),
        'creado'        => array('tipo' => 'fecha_hora', 'etiqueta' => 'Creado',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 91),
        'estatus'       => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Vínculo',
        'etiqueta_plural'    => 'Vínculos',
        'nom_corto_singular' => 'vínculo',
        'nom_corto_plural'   => 'vínculos',
        'mensaje_singular'   => 'el vínculo',
        'mensaje_plural'     => 'los vínculos',
        'clave'              => 'cat_categorias_vinculos',
        'clase_singular'     => 'CatCategoriaVinculo',
        'clase_plural'       => 'CatCategoriasVinculos',
        'instancia_singular' => 'categoria_vinculo',
        'instancia_plural'   => 'categorias_vinculos',
        'archivo_singular'   => 'catcategoriavinculo',
        'archivo_plural'     => 'catcategoriasvinculos',
        'tabla'              => 'cat_categorias_vinculos',
        'vip'                => array(
            'categoria' => array('tipo' => 'relacion', 'etiqueta' => 'Categoría', 'filtro' => 1),
            'nombre'    => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',    'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_sin_herederos();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada modulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['categoria'] = $serpiente->obtener_datos_del_modulo('CatCategorias');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['categoria']      = $serpiente->obtener_datos_del_modulo('CatCategorias');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0243CatCategoriasVinculos

?>
