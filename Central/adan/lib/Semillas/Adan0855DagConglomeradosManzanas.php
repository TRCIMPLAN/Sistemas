<?php
/**
 * TrcIMPLAN Central | Desagregación DagConglomeradosManzanas
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
 * Clase Adan0855DagConglomeradosManzanas
 */
class Adan0855DagConglomeradosManzanas extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagConglomeradosManzanas';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_conglomerados_manzanas';

    // Datos de la tabla
    public $tabla = array(
        'id'           => array('tipo' => 'serial'),
        'conglomerado' => array('tipo' => 'relacion', 'etiqueta' => 'Conglomerado', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 61, 'orden' => 1, 'vip' => 2),
        'manzana'      => array('tipo' => 'relacion', 'etiqueta' => 'Manzana',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 71, 'orden' => 2),

        'estatus'      => array('tipo' => 'caracter', 'etiqueta' => 'Estatus',      'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Manzana',
        'etiqueta_plural'    => 'Manzanas',
        'nom_corto_singular' => 'manzana',
        'nom_corto_plural'   => 'manzanas',
        'mensaje_singular'   => 'la manzana',
        'mensaje_plural'     => 'las manzanas',
        'clave'              => 'dag_conglomerados_manzanas',
        'clase_singular'     => 'DagConglomeradoManzana',
        'clase_plural'       => 'DagConglomeradosManzanas',
        'instancia_singular' => 'conglomerado_manzana',
        'instancia_plural'   => 'conglomerados_manzanas',
        'archivo_singular'   => 'dagconglomeradomanzana',
        'archivo_plural'     => 'dagconglomeradosmanzanas',
        'tabla'              => 'dag_conglomerados_manzanas',
        'vip'                => array(
            'conglomerado' => array('tipo' => 'relacion', 'etiqueta' => 'Conglomerado', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        $this->modulo_sin_herederos();
        $this->modulo_sin_busqueda();
        $this->modulo_solo_consulta();
        // Obtener de Serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada módulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['region']       = $serpiente->obtener_datos_del_modulo('DagRegiones');
        $this->relaciones['conglomerado'] = $serpiente->obtener_datos_del_modulo('DagConglomerados');
        $this->relaciones['entidad']      = $serpiente->obtener_datos_del_modulo('DagEntidades');
        $this->relaciones['municipio']    = $serpiente->obtener_datos_del_modulo('DagMunicipios');
        $this->relaciones['localidad']    = $serpiente->obtener_datos_del_modulo('DagLocalidades');
        $this->relaciones['ageb']         = $serpiente->obtener_datos_del_modulo('DagAgebs');
        $this->relaciones['manzana']      = $serpiente->obtener_datos_del_modulo('DagManzanas');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['conglomerado']      = $serpiente->obtener_datos_del_modulo('DagConglomerados');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones              = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular         = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                    = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0855DagConglomeradosManzanas

?>
