<?php
/**
 * TrcIMPLAN Central | Desagregación DagCatalogos
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
 * Clase Adan0813DagCatalogos
 */
class Adan0813DagCatalogos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagCatalogos';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_catalogos';

    // Datos de la tabla
    public $tabla = array(
        'id'          => array('tipo' => 'serial'),
        'eje'         => array('tipo' => 'relacion',  'etiqueta' => 'Eje',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 81),

        'nivel'       => array('tipo' => 'entero',    'etiqueta' => 'Nivel',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 51, 'orden' => 1),
        'nom_corto'   => array('tipo' => 'nom_corto', 'etiqueta' => 'Nombre corto', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 52, 'vip' => 2),
        'nombre'      => array('tipo' => 'nombre',    'etiqueta' => 'Nombre',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 53),
        'dato_tipo'   => array('tipo' => 'caracter',  'etiqueta' => 'Tipo de dato', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 54,
            'descripciones' => array('E' => 'Cantidad', 'D' => 'Decimal', 'M' => 'Dinero', 'P' => 'Porcentaje', 'C' => 'Caracter', 'S' => 'Texto'),
            'etiquetas'     => array('E' => 'Cantidad', 'D' => 'Decimal', 'M' => 'Dinero', 'P' => 'Porcentaje', 'C' => 'Caracter', 'S' => 'Texto'),
            'colores'       => array('E' => 'amarillo', 'D' => 'naranja', 'M' => 'verde',  'P' => 'rosa',       'C' => 'azul',     'S' => 'azul')),
        'formula'     => array('tipo' => 'frase',     'etiqueta' => 'Fórmula',      'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 55),

        'visibilidad' => array('tipo' => 'caracter',  'etiqueta' => 'Visibilidad',  'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 91,
            'descripciones' => array('O' => 'Oculto', 'V' => 'Visible'),
            'etiquetas'     => array('O' => 'Oculto', 'V' => 'Visible'),
            'colores'       => array('O' => 'gris',   'V' => 'blanco')),
        'estatus'     => array('tipo' => 'caracter',  'etiqueta' => 'Estatus',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Catálogo',
        'etiqueta_plural'    => 'Catálogos',
        'nom_corto_singular' => 'catálogo',
        'nom_corto_plural'   => 'catálogos',
        'mensaje_singular'   => 'el catálogo',
        'mensaje_plural'     => 'los catálogos',
        'clave'              => 'dag_catalogos',
        'clase_singular'     => 'DagCatalogo',
        'clase_plural'       => 'DagCatalogos',
        'instancia_singular' => 'catalogo',
        'instancia_plural'   => 'catalogos',
        'archivo_singular'   => 'dagcatalogo',
        'archivo_plural'     => 'dagcatalogos',
        'tabla'              => 'dag_catalogos',
        'vip'                => array(
            'nom_corto' => array('tipo' => 'nom_corto', 'etiqueta' => 'Catálogo', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        $this->modulo_sin_herederos();
    //  $this->modulo_solo_consulta();
        // Obtener de Serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada módulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['eje']  = $serpiente->obtener_datos_del_modulo('DagEjes');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['eje']       = $serpiente->obtener_datos_del_modulo('DagEjes');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones      = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus            = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0813DagCatalogos

?>
