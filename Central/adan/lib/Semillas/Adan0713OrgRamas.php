<?php
/**
 * TrcIMPLAN Central | Organizador Ramas
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
 * Clase Adan0713OrgRamas
 */
class Adan0713OrgRamas extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'OrgRamas';

    // Nombre de la tabla
    public $tabla_nombre = 'org_ramas';

    // Datos de la tabla
    public $tabla = array(
        'id'               => array('tipo' => 'serial'),
        'arbol'            => array('tipo' => 'relacion', 'etiqueta' => 'Árbol',            'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11,               'vip' => 1),

        'nivel'            => array('tipo' => 'entero',   'etiqueta' => 'Nivel',            'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 21, 'orden' => 1),
        'nom_corto'        => array('tipo' => 'nombre',   'etiqueta' => 'Nombre corto',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 22,               'vip' => 2),
        'nombre'           => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 23),
        'titulo'           => array('tipo' => 'nombre',   'etiqueta' => 'Título',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1),
        'descripcion'      => array('tipo' => 'notas',    'etiqueta' => 'Descripción',      'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'claves'           => array('tipo' => 'nombre',   'etiqueta' => 'Claves',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1),
        'encabezado_color' => array('tipo' => 'nombre',   'etiqueta' => 'Color encabezado', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'nombre_menu'      => array('tipo' => 'frase',    'etiqueta' => 'Menú',             'validacion' => 2, 'agregar' => 1, 'modificar' => 1),
        'concentrador'     => array('tipo' => 'caracter', 'etiqueta' => 'Concentrador',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 31,
            'descripciones' => array('G' => 'Galería', 'I' => 'Índice', 'T' => 'Tarjetas'),
            'etiquetas'     => array('G' => 'Galería', 'I' => 'Índice', 'T' => 'Tarjetas'),
            'colores'       => array('G' => 'azul',    'I' => 'verde',  'T' => 'naranja')),
        'directorio'       => array('tipo' => 'nombre',   'etiqueta' => 'Directorio',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 41),
        'namespace'        => array('tipo' => 'nombre',   'etiqueta' => 'Namespace',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 42),

        'estatus'          => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Rama',
        'etiqueta_plural'    => 'Ramas',
        'nom_corto_singular' => 'rama',
        'nom_corto_plural'   => 'ramas',
        'mensaje_singular'   => 'la rama',
        'mensaje_plural'     => 'las ramas',
        'clave'              => 'org_ramas',
        'clase_singular'     => 'OrgRama',
        'clase_plural'       => 'OrgRamas',
        'instancia_singular' => 'rama',
        'instancia_plural'   => 'ramas',
        'archivo_singular'   => 'orgrama',
        'archivo_plural'     => 'orgramas',
        'tabla'              => 'org_ramas',
        'vip'                => array(
            'nom_corto' => array('tipo' => 'nombre',   'etiqueta' => 'Rama',  'filtro' => 1),
            'arbol'     => array('tipo' => 'relacion', 'etiqueta' => 'Árbol', 'filtro' => 1))
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
        $this->relaciones['arbol'] = $serpiente->obtener_datos_del_modulo('OrgArboles');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['arbol']      = $serpiente->obtener_datos_del_modulo('OrgArboles');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['vinculos']   = $serpiente->obtener_datos_del_modulo('OrgVinculos');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones       = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular  = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus             = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0713OrgRamas

?>
