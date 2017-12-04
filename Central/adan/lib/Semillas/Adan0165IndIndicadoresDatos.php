<?php
/**
 * TrcIMPLAN Central | Indicadores Datos
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
 * Clase Adan0165IndIndicadoresDatos
 */
class Adan0165IndIndicadoresDatos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'IndIndicadoresDatos';

    // Nombre de la tabla
    public $tabla_nombre = 'ind_indicadores_datos';

    // Datos de la tabla
    public $tabla = array(
        'id'         => array('tipo' => 'serial'),

        'fecha'      => array('tipo' => 'fecha',      'etiqueta' => 'Fecha',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 11, 'orden' => 1, 'vip' => 2),

        'indicador'  => array('tipo' => 'relacion',   'etiqueta' => 'Indicador',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21),

        'region'     => array('tipo' => 'relacion',   'etiqueta' => 'Región',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 31, 'orden' => 2),

        'cantidad'   => array('tipo' => 'entero',     'etiqueta' => 'Dato cantidad',   'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 41),
        'decimal'    => array('tipo' => 'flotante',   'etiqueta' => 'Dato decimal',    'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 42),
        'dinero'     => array('tipo' => 'dinero',     'etiqueta' => 'Dato dinero',     'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 43),
        'porcentaje' => array('tipo' => 'porcentaje', 'etiqueta' => 'Dato porcentaje', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 44),
        'caracter'   => array('tipo' => 'caracter',   'etiqueta' => 'Dato caracter',   'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 45,
            'descripciones' => array('Z' => 'No aplica', 'X' => 'No tiene', 'Y' => 'No disponible', 'M' => 'Hombres', 'F' => 'Mujeres'),
            'etiquetas'     => array('Z' => 'No aplica', 'X' => 'No tiene', 'Y' => 'No disponible', 'M' => 'Hombres', 'F' => 'Mujeres'),
            'colores'       => array('Z' => 'rojo',      'X' => 'gris',     'Y' => 'amarillo',      'M' => 'azul',    'F' => 'rosa')),

        'fuente'     => array('tipo' => 'relacion',   'etiqueta' => 'Fuente',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 71),

        'notas'      => array('tipo' => 'notas',      'etiqueta' => 'Notas',           'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estatus'    => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',         'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Dato',
        'etiqueta_plural'    => 'Datos',
        'nom_corto_singular' => 'dato',
        'nom_corto_plural'   => 'datos',
        'mensaje_singular'   => 'el dato',
        'mensaje_plural'     => 'los datos',
        'clave'              => 'ind_indicadores_datos',
        'clase_singular'     => 'IndIndicadorDato',
        'clase_plural'       => 'IndIndicadoresDatos',
        'instancia_singular' => 'indicador_dato',
        'instancia_plural'   => 'indicadores_datos',
        'archivo_singular'   => 'indindicadordato',
        'archivo_plural'     => 'indindicadoresdatos',
        'tabla'              => 'ind_indicadores_datos',
        'vip'                => array(
            'fecha' => array('tipo' => 'fecha', 'etiqueta' => 'Fecha', 'filtro' => 1))
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
        $this->relaciones['subindice'] = $serpiente->obtener_datos_del_modulo('IndSubindices');
        $this->relaciones['indicador'] = $serpiente->obtener_datos_del_modulo('IndIndicadores');
        $this->relaciones['fuente']    = $serpiente->obtener_datos_del_modulo('CatFuentes');
        $this->relaciones['region']    = $serpiente->obtener_datos_del_modulo('CatRegiones');
        $this->relaciones['unidad']    = $serpiente->obtener_datos_del_modulo('CatUnidades');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['indicador']      = $serpiente->obtener_datos_del_modulo('IndIndicadores');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0165IndIndicadoresDatos

?>
