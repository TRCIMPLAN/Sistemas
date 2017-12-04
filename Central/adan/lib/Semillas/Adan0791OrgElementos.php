<?php
/**
 * TrcIMPLAN Central | Organizador Elementos
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
 * Clase Adan0791OrgElementos
 */
class Adan0791OrgElementos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'OrgElementos';

    // Nombre de la tabla
    public $tabla_nombre = 'org_elementos';

    // Datos de la tabla
    public $tabla = array(
        'id'        => array('tipo' => 'serial',     'etiqueta' => 'ID',                                                                            'listado' => 11, 'vip' => 2),

        'creado'    => array('tipo' => 'fecha_hora', 'etiqueta' => 'Fecha',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 21, 'orden' => -1),

        'vinculo'   => array('tipo' => 'relacion',   'etiqueta' => 'Vínculo',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 31),
        'autor'     => array('tipo' => 'relacion',   'etiqueta' => 'Autor',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 41),
        'categoria' => array('tipo' => 'relacion',   'etiqueta' => 'Categoría', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 51),
        'region'    => array('tipo' => 'relacion',   'etiqueta' => 'Región',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 61),
        'fuente'    => array('tipo' => 'relacion',   'etiqueta' => 'Fuente',    'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 71),

        'estatus'   => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',   'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Elemento',
        'etiqueta_plural'    => 'Elementos',
        'nom_corto_singular' => 'elemento',
        'nom_corto_plural'   => 'elementos',
        'mensaje_singular'   => 'el elemento',
        'mensaje_plural'     => 'los elementos',
        'clave'              => 'org_elementos',
        'clase_singular'     => 'OrgElemento',
        'clase_plural'       => 'OrgElementos',
        'instancia_singular' => 'elemento',
        'instancia_plural'   => 'elementos',
        'archivo_singular'   => 'orgelemento',
        'archivo_plural'     => 'orgelementos',
        'tabla'              => 'org_elementos',
        'vip'                => array(
            'id' => array('tipo' => 'entero', 'etiqueta' => 'Elemento', 'filtro' => 1))
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
        $this->relaciones['arbol']     = $serpiente->obtener_datos_del_modulo('OrgArboles');
        $this->relaciones['rama']      = $serpiente->obtener_datos_del_modulo('OrgRamas');
        $this->relaciones['vinculo']   = $serpiente->obtener_datos_del_modulo('OrgVinculos');
        $this->relaciones['autor']     = $serpiente->obtener_datos_del_modulo('OrgAutores');
        $this->relaciones['categoria'] = $serpiente->obtener_datos_del_modulo('OrgCategorias');
        $this->relaciones['region']    = $serpiente->obtener_datos_del_modulo('OrgRegiones');
        $this->relaciones['fuente']    = $serpiente->obtener_datos_del_modulo('OrgFuentes');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['vinculo']        = $serpiente->obtener_datos_del_modulo('OrgVinculos');
        $this->padre['autor']          = $serpiente->obtener_datos_del_modulo('OrgAutores');
        $this->padre['categoria']      = $serpiente->obtener_datos_del_modulo('OrgCategorias');
        $this->padre['region']         = $serpiente->obtener_datos_del_modulo('OrgRegiones');
        $this->padre['fuente']         = $serpiente->obtener_datos_del_modulo('OrgFuentes');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones           = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular      = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                 = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0791OrgElementos

?>
