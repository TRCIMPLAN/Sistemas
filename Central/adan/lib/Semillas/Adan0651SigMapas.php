<?php
/**
 * TrcIMPLAN Central | SIG Mapas
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
 * Clase Adan0651SigMapas
 */
class Adan0651SigMapas extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'SigMapas';

    // Nombre de la tabla
    public $tabla_nombre = 'sig_mapas';

    // Datos de la tabla
    public $tabla = array(
        'id'                         => array('tipo' => 'serial'),
        'autor'                      => array('tipo' => 'relacion',   'etiqueta' => 'Autor',                'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 61),
        'imprenta'                   => array('tipo' => 'relacion',   'etiqueta' => 'Imprenta',             'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 71),
        'region'                     => array('tipo' => 'relacion',   'etiqueta' => 'Región',               'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 81),

        'fecha'                      => array('tipo' => 'fecha_hora', 'etiqueta' => 'Fecha',                'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 21),
        'nombre'                     => array('tipo' => 'nombre',     'etiqueta' => 'Nombre',               'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 2),
        'descripcion'                => array('tipo' => 'notas',      'etiqueta' => 'Descripción',          'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),
        'categorias'                 => array('tipo' => 'nombre',     'etiqueta' => 'Categorías',           'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 22),
        'palabras_clave'             => array('tipo' => 'nombre',     'etiqueta' => 'Palabras clave',       'validacion' => 1, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),

        'imagen'                     => array('tipo' => 'nombre',     'etiqueta' => 'Imagen',               'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'imagen_previa'              => array('tipo' => 'nombre',     'etiqueta' => 'Imagen previa',        'validacion' => 1, 'agregar' => 1, 'modificar' => 1),

        'tipo'                       => array('tipo' => 'caracter',   'etiqueta' => 'Tipo',                 'validacion' => 2, 'agregar' => 1, 'modificar' => 1,
            'descripciones' => array('V' => 'Mapa Local', 'T' => 'Tránsito', 'E' => 'Estacionamiento', 'S' => 'Asientos'),
            'etiquetas'     => array('V' => 'Mapa Local', 'T' => 'Tránsito', 'E' => 'Estacionamiento', 'S' => 'Asientos'),
            'colores'       => array('V' => 'verde',      'T' => 'amarillo', 'E' => 'azul',            'S' => 'rosa')),
        'pantalla_completa_url'      => array('tipo' => 'frase',      'etiqueta' => 'P. Completa URL',      'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'pantalla_completa_etiqueta' => array('tipo' => 'nombre',     'etiqueta' => 'P. Completa etiqueta', 'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'caja_html'                  => array('tipo' => 'notas',      'etiqueta' => 'Caja HTML',            'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'caja_js'                    => array('tipo' => 'notas',      'etiqueta' => 'Javascript',           'validacion' => 1, 'agregar' => 1, 'modificar' => 1),

        'para_compartir'             => array('tipo' => 'caracter',   'etiqueta' => 'Para compartir',       'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 91,
            'descripciones' => array('C' => 'Compartir', 'N' => 'No compartir'),
            'etiquetas'     => array('C' => 'Compartir', 'N' => 'No compartir'),
            'colores'       => array('C' => 'verde',     'N' => 'rojo')),
        'estado'                     => array('tipo' => 'caracter',   'etiqueta' => 'Estado',               'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 92,
            'descripciones' => array('I' => 'Ignorar', 'R' => 'Revisar', 'P' => 'Publicar'),
            'etiquetas'     => array('I' => 'Ignorar', 'R' => 'Revisar', 'P' => 'Publicar'),
            'colores'       => array('I' => 'gris',    'R' => 'azul',    'P' => 'verde')),
        'estatus'                    => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',              'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Mapa',
        'etiqueta_plural'    => 'Mapas',
        'nom_corto_singular' => 'mapa',
        'nom_corto_plural'   => 'mapas',
        'mensaje_singular'   => 'el mapa',
        'mensaje_plural'     => 'los mapas',
        'clave'              => 'sig_mapas',
        'clase_singular'     => 'SigMapa',
        'clase_plural'       => 'SigMapas',
        'instancia_singular' => 'mapa',
        'instancia_plural'   => 'mapas',
        'archivo_singular'   => 'sigmapa',
        'archivo_plural'     => 'sigmapas',
        'tabla'              => 'sig_mapas',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre', 'etiqueta' => 'Mapa', 'filtro' => 1))
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
        $this->relaciones['autor']    = $serpiente->obtener_datos_del_modulo('SigAutores');
        $this->relaciones['imprenta'] = $serpiente->obtener_datos_del_modulo('SigImprentas');
        $this->relaciones['region']   = $serpiente->obtener_datos_del_modulo('CatRegiones');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['autor']         = $serpiente->obtener_datos_del_modulo('SigAutores');
        $this->padre['imprenta']      = $serpiente->obtener_datos_del_modulo('SigImprentas');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones          = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular     = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus                = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0651SigMapas

?>
