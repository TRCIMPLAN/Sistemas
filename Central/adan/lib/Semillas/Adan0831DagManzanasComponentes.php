<?php
/**
 * TrcIMPLAN Central | Desagregación DagManzanasComponentes
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
 * Clase Adan0831DagManzanasComponentes
 */
class Adan0831DagManzanasComponentes extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'DagManzanasComponentes';

    // Nombre de la tabla
    public $tabla_nombre = 'dag_manzanas_componentes';

    // Datos de la tabla
    public $tabla = array(
        'id'         => array('tipo' => 'serial'),
        'manzana'    => array('tipo' => 'relacion',   'etiqueta' => 'Manzana',         'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21),
        'catalogo'   => array('tipo' => 'relacion',   'etiqueta' => 'Catalogo',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 31),

        'fecha'      => array('tipo' => 'fecha',      'etiqueta' => 'Fecha',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'dato'       => array('tipo' => 'flotante',   'etiqueta' => 'Dato',            'validacion' => 1, 'agregar' => 1, 'modificar' => 1,                'listado' => 51),

        'estatus'    => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',         'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Componente',
        'etiqueta_plural'    => 'Componentes',
        'nom_corto_singular' => 'componente',
        'nom_corto_plural'   => 'componentes',
        'mensaje_singular'   => 'el componenete',
        'mensaje_plural'     => 'los componentes',
        'clave'              => 'dag_manzanas_componentes',
        'clase_singular'     => 'DagManzanaComponente',
        'clase_plural'       => 'DagManzanasComponentes',
        'instancia_singular' => 'manzana_componente',
        'instancia_plural'   => 'manzanas_componentes',
        'archivo_singular'   => 'dagmanzanacomponente',
        'archivo_plural'     => 'dagmanzanascomponentes',
        'tabla'              => 'dag_manzanas_componentes',
        'vip'                => array(
            'fecha' => array('tipo' => 'fecha', 'etiqueta' => 'Componente', 'filtro' => 1))
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Programas a escribir
        $this->modulo_completo();
        $this->modulo_solo_consulta();
        $this->modulo_sin_herederos();
        // Obtener de Serpiente
        $serpiente = new Serpiente();
        // Relaciones, cada módulo con el que está relacionado sin incluir a los hijos
        $this->relaciones['entidad']   = $serpiente->obtener_datos_del_modulo('DagEntidades');
        $this->relaciones['municipio'] = $serpiente->obtener_datos_del_modulo('DagMunicipios');
        $this->relaciones['localidad'] = $serpiente->obtener_datos_del_modulo('DagLocalidades');
        $this->relaciones['ageb']      = $serpiente->obtener_datos_del_modulo('DagAgebs');
        $this->relaciones['manzana']   = $serpiente->obtener_datos_del_modulo('DagManzanas');
        $this->relaciones['eje']       = $serpiente->obtener_datos_del_modulo('DagEjes');
        $this->relaciones['catalogo']  = $serpiente->obtener_datos_del_modulo('DagCatalogos');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['manzana']        = $serpiente->obtener_datos_del_modulo('DagManzanas');
        // Siempre se debe de cargar de serpiente esta información
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0831DagManzanasComponentes

?>
