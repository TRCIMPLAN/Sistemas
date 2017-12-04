<?php
/**
 * TrcIMPLAN Central | Investigaciones
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
 * Clase Adan0371InvInvestigaciones
 */
class Adan0371InvInvestigaciones extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'InvInvestigaciones';

    // Nombre de la tabla
    public $tabla_nombre = 'inv_investigaciones';

    // Datos de la tabla
    public $tabla = array(
        'id'                    => array('tipo' => 'serial'),

        'fecha'                 => array('tipo' => 'fecha',    'etiqueta' => 'Fecha',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 1),
        'titulo'                => array('tipo' => 'nombre',   'etiqueta' => 'Título',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 13, 'orden' => 2, 'vip' => 2),
        'autor'                 => array('tipo' => 'nombre',   'etiqueta' => 'Autor',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 15),

        'prefacio'              => array('tipo' => 'notas',    'etiqueta' => 'Resumen',         'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),
        'contenido'             => array('tipo' => 'notas',    'etiqueta' => 'Contenido',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),
        'conclusiones'          => array('tipo' => 'notas',    'etiqueta' => 'Conclusiones',    'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),

        'investigacion_calidad' => array('tipo' => 'relacion', 'etiqueta' => 'Clasif. Calidad', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21),
        'investigacion_fuente'  => array('tipo' => 'relacion', 'etiqueta' => 'Clasif. Fuente',  'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 31),
        'investigacion_alcance' => array('tipo' => 'relacion', 'etiqueta' => 'Clasif. Alcance', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 41),
        'fuente'                => array('tipo' => 'relacion', 'etiqueta' => 'Fuente',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 51),

        'url'                   => array('tipo' => 'frase',    'etiqueta' => 'URL',             'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 61),
        'categorias'            => array('tipo' => 'nombre',   'etiqueta' => 'Categorías',      'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 63,               'vip' => 1),

        'notas'                 => array('tipo' => 'notas',    'etiqueta' => 'Notas',           'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'               => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',         'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Investigación',
        'etiqueta_plural'    => 'Investigaciones',
        'nom_corto_singular' => 'investigación',
        'nom_corto_plural'   => 'investigaciones',
        'mensaje_singular'   => 'la investigación',
        'mensaje_plural'     => 'las investigaciones',
        'clave'              => 'inv_investigaciones',
        'clase_singular'     => 'InvInvestigacion',
        'clase_plural'       => 'InvInvestigaciones',
        'instancia_singular' => 'investigacion',
        'instancia_plural'   => 'investigaciones',
        'archivo_singular'   => 'invinvestigacion',
        'archivo_plural'     => 'invinvestigaciones',
        'tabla'              => 'inv_investigaciones',
        'vip'                => array(
            'titulo' => array('tipo' => 'nombre', 'etiqueta' => 'Título', 'filtro' => 1))
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
        $this->relaciones['investigacion_calidad'] = $serpiente->obtener_datos_del_modulo('CatInvestigacionesCalidades');
        $this->relaciones['investigacion_fuente']  = $serpiente->obtener_datos_del_modulo('CatInvestigacionesFuentes');
        $this->relaciones['investigacion_alcance'] = $serpiente->obtener_datos_del_modulo('CatInvestigacionesAlcances');
        $this->relaciones['fuente']                = $serpiente->obtener_datos_del_modulo('CatFuentes');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['investigacion_calidad']      = $serpiente->obtener_datos_del_modulo('CatInvestigacionesCalidades');
        $this->padre['investigacion_fuente']       = $serpiente->obtener_datos_del_modulo('CatInvestigacionesFuentes');
        $this->padre['investigacion_alcance']      = $serpiente->obtener_datos_del_modulo('CatInvestigacionesAlcances');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones                       = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular                  = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                             = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0371InvInvestigaciones

?>
