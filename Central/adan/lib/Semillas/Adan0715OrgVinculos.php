<?php
/**
 * TrcIMPLAN Central | Organizador Vínculos
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
 * Clase Adan0715OrgVinculos
 */
class Adan0715OrgVinculos extends \Arbol\Adan {

    // Nombre de este modulo
    public $nombre = 'OrgVinculos';

    // Nombre de la tabla
    public $tabla_nombre = 'org_vinculos';

    // Datos de la tabla
    public $tabla = array(
        'id'             => array('tipo' => 'serial'),
        'rama'           => array('tipo' => 'relacion',   'etiqueta' => 'Rama',           'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 11, 'orden' => 1, 'vip' => 1),

        'nivel'          => array('tipo' => 'entero',     'etiqueta' => 'Nivel',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 21, 'orden' => 2),
        'nombre'         => array('tipo' => 'frase',      'etiqueta' => 'Nombre',         'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 22, 'orden' => 3, 'vip' => 2),
        'descripcion'    => array('tipo' => 'notas',      'etiqueta' => 'Descripción',    'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'creado'         => array('tipo' => 'fecha_hora', 'etiqueta' => 'Fecha',          'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 2, 'listado' => 23),
        'directorio'     => array('tipo' => 'frase',      'etiqueta' => 'Directorio',     'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1),
        'archivo'        => array('tipo' => 'frase',      'etiqueta' => 'Archivo',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1),
        'url'            => array('tipo' => 'frase',      'etiqueta' => 'URL',            'validacion' => 2, 'agregar' => 1, 'modificar' => 1),
        'imagen'         => array('tipo' => 'frase',      'etiqueta' => 'Imagen',         'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'imagen_previa'  => array('tipo' => 'frase',      'etiqueta' => 'Imagen previa',  'validacion' => 1, 'agregar' => 1, 'modificar' => 1),
        'estado'         => array('tipo' => 'caracter',   'etiqueta' => 'Estado',         'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 71,
            'descripciones' => array('P' => 'Publicar', 'R' => 'Revisar',  'I' => 'Ignorar'),
            'etiquetas'     => array('P' => 'Publicar', 'R' => 'Revisar',  'I' => 'Ignorar'),
            'colores'       => array('P' => 'verde',    'R' => 'amarillo', 'I' => 'gris')),
        'para_compartir' => array('tipo' => 'caracter',   'etiqueta' => 'Para compartir', 'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 72,
            'descripciones' => array('S' => 'Compartir', 'N' => 'NO Compartir'),
            'etiquetas'     => array('S' => 'Compartir', 'N' => 'NO Compartir'),
            'colores'       => array('S' => 'verde',     'N' => 'rojo')),

        'estatus'        => array('tipo' => 'caracter',   'etiqueta' => 'Estatus',        'validacion' => 2, 'agregar' => 1, 'modificar' => 1, 'filtro' => 1, 'listado' => 99,
            'descripciones' => array('A' => 'En uso',       'B' => 'Eliminado'),
            'etiquetas'     => array('A' => 'En Uso',       'B' => 'Eliminado'),
            'colores'       => array('A' => 'blanco',       'B' => 'gris'),
            'acciones'      => array('A' => 'listadoenuso', 'B' => 'listadoeliminados'))
    );

    // Reptil es leido por Serpiente
    static public $reptil = array(
        'etiqueta_singular'  => 'Vínculo',
        'etiqueta_plural'    => 'Vínculos',
        'nom_corto_singular' => 'vínculo',
        'nom_corto_plural'   => 'vínculos',
        'mensaje_singular'   => 'el vínculo',
        'mensaje_plural'     => 'los vínculos',
        'clave'              => 'org_vinculos',
        'clase_singular'     => 'OrgVinculo',
        'clase_plural'       => 'OrgVinculos',
        'instancia_singular' => 'vinculo',
        'instancia_plural'   => 'vinculos',
        'archivo_singular'   => 'orgvinculo',
        'archivo_plural'     => 'orgvinculos',
        'tabla'              => 'org_vinculos',
        'vip'                => array(
            'nombre' => array('tipo' => 'nombre',   'etiqueta' => 'Vínculo', 'filtro' => 1),
            'rama'   => array('tipo' => 'relacion', 'etiqueta' => 'Rama',    'filtro' => 1))
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
        $this->relaciones['rama']  = $serpiente->obtener_datos_del_modulo('OrgRamas');
        // Padre, el módulo que mostrará a éste como un listado debajo de aquel
        $this->padre['rama']       = $serpiente->obtener_datos_del_modulo('OrgRamas');
        // Hijos, los módulos que se mostrarán debajo del detalle como listados
        $this->hijos['elementos']  = $serpiente->obtener_datos_del_modulo('OrgElementos');
        // Siempre se debe de cargar de serpiente esta informacion
        $this->sustituciones       = $serpiente->obtener_sustituciones($this->nombre);
        $this->instancia_singular  = $serpiente->obtener_instancia_singular($this->nombre);
        $this->estatus             = $serpiente->obtener_estatus($this->nombre);
    } // constructor

} // Clase Adan0715OrgVinculos

?>
