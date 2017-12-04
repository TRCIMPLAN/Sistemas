<?php
/**
 * TrcIMPLAN Central | Catálogos Investigaciones Calidades
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
 * Clase Adan0341CatInvestigacionesCalidades
 */
class Adan0341CatInvestigacionesCalidades extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'CatInvestigacionesCalidades';

    // Nombre de la tabla
    public $tabla_nombre = 'cat_investigaciones_calidades';

    // Datos de la tabla
    public $tabla = array(
        'id'          => array('tipo' => 'serial'),

        'nombre'      => array('tipo' => 'nombre',   'etiqueta' => 'Nombre',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'descripcion' => array('tipo' => 'frase',    'etiqueta' => 'Descripción', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21,               'vip' => 1),

        'notas'       => array('tipo' => 'notas',    'etiqueta' => 'Notas',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'     => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Clasificación por la calidad de la investigación',
        'etiqueta_plural'    => 'Clasificaciones por las calidades de las investigaciones',
        'nom_corto_singular' => 'calidad',
        'nom_corto_plural'   => 'calidades',
        'mensaje_singular'   => 'la calidad de la investigación',
        'mensaje_plural'     => 'las calidades de las investigaciones',
        'clave'              => 'cat_investigaciones_calidades',
        'clase_singular'     => 'CatInvestigacionCalidad',
        'clase_plural'       => 'CatInvestigacionesCalidades',
        'instancia_singular' => 'investigacion_calidad',
        'instancia_plural'   => 'investigaciones_calidades',
        'archivo_singular'   => 'catinvestigacioncalidad',
        'archivo_plural'     => 'catinvestigacionescalidades',
        'tabla'              => 'cat_investigaciones_calidades',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Clasif. Calidad', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_sin_busqueda();
        // Obtener de serpiente
        $serpiente = new Serpiente();
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['investigaciones'] = $serpiente->obtener_datos_del_modulo('InvInvestigaciones');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones            = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular       = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                  = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0341CatInvestigacionesCalidades

?>
