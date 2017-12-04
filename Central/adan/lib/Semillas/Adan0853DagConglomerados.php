<?php
/**
 * TrcIMPLAN Central | Desagregación DagConglomerados
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
 * Clase Adan0853DagConglomerados
 */
class Adan0853DagConglomerados extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagConglomerados';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_conglomerados';

    // Datos de la tabla
    public $tabla = array(
        'id'                => array('tipo' => 'serial'),
        'region'            => array('tipo' => 'relacion',   'etiqueta' => 'Región',                    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 81),

        'nombre'            => array('tipo' => 'nombre',     'etiqueta' => 'Nombre',                    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'nom_corto'         => array('tipo' => 'nom_corto',  'etiqueta' => 'Nombre corto',              'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),

        'pobtot'            => array('tipo' => 'entero',     'etiqueta' => 'Pob. Total',                                                                                    'listado' => 21),
        'porpobmas'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Masculina'),
        'porpobfem'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Femenina'),
        'porpob0a14'        => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. de 0 a 14 años'),
        'porpob15a64'       => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. de 15 a 64 años'),
        'porpob65ymas'      => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. de 65 y más años'),
        'porpobrne'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. con Edad NO Especif.'),
        'promhnv'           => array('tipo' => 'flotante',   'etiqueta' => 'Fecundidad promedio'),
    //  'porpobnacoe'       => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Nac. en otro estado'),
        'porpobclim'        => array('tipo' => 'porcentaje', 'etiqueta' => 'Discapacidad'),

    //  'gpe'               => array('tipo' => 'flotante',   'etiqueta' => 'Grado Prom. de Esc.'),
    //  'gpemas'            => array('tipo' => 'flotante',   'etiqueta' => 'Grado Prom. de Esc. Mas.'),
    //  'gpefem'            => array('tipo' => 'flotante',   'etiqueta' => 'Grado Prom. de Esc. Fem.'),
    //  'porpob15ymasanalf' => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. de 15 y más analfabeta'),
    //  'porpob18ymas'      => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. de 18 y más'),
    //  'porpob18ymaspb'    => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. de 18 y más postbásicos'),

        'pea'               => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Econ. Activa'),
        'peamas'            => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Econ. Activa Mas.'),
        'peafem'            => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Econ. Activa Fem.'),
        'pobocu'            => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Ocupada'),
        'pobocumas'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Ocupada masculina'),
        'pobocufem'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Ocupada femenina'),
        'pobdesocu'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Pob. Desocupada'),
        'derechohab'        => array('tipo' => 'porcentaje', 'etiqueta' => 'Derechohabiencia'),

        'hogares'           => array('tipo' => 'entero',     'etiqueta' => 'Hogares',                                                                                       'listado' => 51),
    //  'hogjefmas'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Hogares Jef. Mas.'),
    //  'hogjeffem'         => array('tipo' => 'porcentaje', 'etiqueta' => 'Hogares Jef. Fem.'),
        'ocuviv'            => array('tipo' => 'flotante',   'etiqueta' => 'Ocupación por Vivienda'),
        'vivelect'          => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Electricidad'),
        'vivagua'           => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Agua'),
        'vivdrenaje'        => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Drenaje'),
        'vivtv'             => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Televisión'),
        'vivauto'           => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Automóvil'),
        'vivcompu'          => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Computadora'),
    //  'vivcelular'        => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Celular'),
    //  'vivinternet'       => array('tipo' => 'porcentaje', 'etiqueta' => 'Viv. con Internet'),

        'aetot'             => array('tipo' => 'entero',     'etiqueta' => 'Total de Act. Econ.',                                                                           'listado' => 61),
        'aetop1actividad'   => array('tipo' => 'frase',      'etiqueta' => '1° Actividad'),
        'aetop1valor'       => array('tipo' => 'porcentaje', 'etiqueta' => '1° Porcentaje'),
    //  'aetop1'            => array('tipo' => 'frase',      'etiqueta' => 'Primer actividad'),
        'aetop2actividad'   => array('tipo' => 'frase',      'etiqueta' => '2° Actividad'),
        'aetop2valor'       => array('tipo' => 'porcentaje', 'etiqueta' => '2° Porcentaje'),
    //  'aetop2'            => array('tipo' => 'frase',      'etiqueta' => 'Segunda actividad'),
        'aetop3actividad'   => array('tipo' => 'frase',      'etiqueta' => '3° Actividad'),
        'aetop3valor'       => array('tipo' => 'porcentaje', 'etiqueta' => '3° Porcentaje'),
    //  'aetop3'            => array('tipo' => 'frase',      'etiqueta' => 'Tercer actividad'),
        'aetop4actividad'   => array('tipo' => 'frase',      'etiqueta' => '4° Actividad'),
        'aetop4valor'       => array('tipo' => 'porcentaje', 'etiqueta' => '4° Porcentaje'),
    //  'aetop4'            => array('tipo' => 'frase',      'etiqueta' => 'Cuarta actividad'),
        'aetop5actividad'   => array('tipo' => 'frase',      'etiqueta' => '5° Actividad'),
        'aetop5valor'       => array('tipo' => 'porcentaje', 'etiqueta' => '5° Porcentaje'),
    //  'aetop5'            => array('tipo' => 'frase',      'etiqueta' => 'Quinta actividad'),

        'centro'            => array('tipo' => 'geopunto',   'etiqueta' => 'Centro'),

        'notas'             => array('tipo' => 'notas',      'etiqueta' => 'Notas',                     'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'creado'            => array('tipo' => 'fecha_hora', 'etiqueta' => 'Creado'),
        'modificado'        => array('tipo' => 'fecha_hora', 'etiqueta' => 'Modificado',                                                                     'filtro' => 2, 'listado' => 91),
        'visibilidad'       => array('tipo' => 'caracter',   'etiqueta' => 'Visibilidad',               'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 97,
            'descripciones' => array('O' => 'Oculto', 'V' => 'Visible'),
            'etiquetas'     => array('O' => 'Oculto', 'V' => 'Visible'),
            'colores'       => array('O' => 'gris',   'V' => 'blanco')),
        'estatus'           => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',                   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Conglomerado',
        'etiqueta_plural'    => 'Conglomerados',
        'nom_corto_singular' => 'conglomerado',
        'nom_corto_plural'   => 'conglomerados',
        'mensaje_singular'   => 'el conglomerado',
        'mensaje_plural'     => 'los conglomerados',
        'clave'              => 'dag_conglomerados',
        'clase_singular'     => 'DagConglomerado',
        'clase_plural'       => 'DagConglomerados',
        'instancia_singular' => 'conglomerado',
        'instancia_plural'   => 'conglomerados',
        'archivo_singular'   => 'dagconglomerado',
        'archivo_plural'     => 'dagconglomerados',
        'tabla'              => 'dag_conglomerados',
        'vip'                => array(
            'nom_corto' => array('tipo' => 'nombre', 'etiqueta' => 'Conglomerado', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        // Obtener de Serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada modulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['region'] = $serpiente->obtener_datos_del_modulo('DagRegiones');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['region']      = $serpiente->obtener_datos_del_modulo('DagRegiones');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['manzanas']    = $serpiente->obtener_datos_del_modulo('DagConglomeradosManzanas');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones        = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular   = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus              = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0853DagConglomerados

?>
