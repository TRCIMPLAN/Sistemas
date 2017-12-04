#!/usr/bin/env php
<?php
/**
 * TrcIMPLAN Central - Alimentar Categorías Vínculos
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
 * @package TrcIMPLANCentral
 */

// Soy
$soy = '[Alimentar Categorías Vínculos]';

// Valores de salida
$EXITO=0;
$E_FATAL=99;

/*
 * A partir de aquí el directorio base es bin/trcimplan.github.io
 * para cargar los archivos con las publicaciones
 */

// Cambiarse al directorio SMIbeta
chdir(realpath(dirname(__FILE__)).'/trcimplan.github.io');

// TODOS LOS CARACTERES SERAN UTF-8
mb_internal_encoding('utf-8');

// AUTOCARGADOR DE CLASES
spl_autoload_register(
    /**
     * Auto-cargador de Clases
     *
     * @param string Creación de la instancia
     */
    function ($className) {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
        require 'lib/'.$fileName;
    } // auto-cargador de clases
);

// Arreglo con los directorios de donde se tomarán las publicaciones
$directorios = array(
    'Blog',
    'Proyectos',
    'SIGMapasTorreon',
    'SIGPlanes',
    'SMIIndicadoresTorreon',
    'SMIIndicadoresGomezPalacio',
    'SMIIndicadoresLerdo',
    'SMIIndicadoresMatamoros',
    'SMIIndicadoresLaLaguna');

// Recolectar publicaciones
echo "Recolectando publicaciones...\n";
$impresor = new \Base\Imprenta();
try {
    foreach ($directorios as $dir) {
        echo "  Cargando archivos de $dir...\n";
        $archivos = $impresor->agregar_directorio_publicaciones($dir);
    }
} catch (\Exception $e) {
    echo implode("\n", $impresor->mensajes)."\n";
    echo "$soy ".$e->getMessage()."\n";
    exit($E_FATAL);
}

/*
 * A partir de aquí el directorio base es bin
 * para insertar registros a la base de datos
 */

// Cambiarse al directorio bin, donde está este script
chdir(realpath(dirname(__FILE__)));

// Cargar funciones
require_once('../lib/Base/Funciones.php');

// Cargar sesión
$sesion = new \Inicio\Sesion('sistema');

// Eliminar registros de la tabla Categorías, esto eliminará también los Vínculos
echo "Eliminando registros de las tablas Categorías y Vínculos...\n";
$eliminador = new \CatCategorias\Eliminador($sesion);
try {
    $eliminador->eliminar()."\n";
} catch (\Exception $e) {
    echo "$soy ERROR: ".$e->getMessage()."\n";
    exit($E_FATAL);
}

// Arreglo asociativo ID => Nombre con las categorías agregadas
$categorias_arreglo = array();

// Bucle por las Publicaciones
echo "Alimentándose de las Categorías y Vínculos de las Publicaciones...\n";
foreach ($impresor->publicaciones as $p) {
    $p->en_raiz = true;
    // Bucle por las Categorías de la Publicación
    if (is_array($p->categorias)) {
        foreach ($p->categorias as $c) {
            // Si NO está en el arreglo, agregarla
            if (!in_array($c, $categorias_arreglo)) {
                // Agregar la Categoría a la base de datos
                $categoria          = new \CatCategorias\Registro($sesion);
                $categoria->nombre  = $c;
                $categoria->estatus = 'A';
                try {
                    $categoria->agregar();
                } catch (\Exception $e) {
                    echo "$soy ERROR: ".$e->getMessage()."\n";
                    exit($E_FATAL);
                }
                // Agregar la categoría al arreglo asociativo
                $categorias_arreglo[$categoria->id] = $categoria->nombre;
                echo "  Nueva categoría {$categoria->nombre}\n";
            }
            // Agregar los Vínculos de la Categoría
            $vinculo                = new \CatCategoriasVinculos\Registro($sesion);
            $vinculo->categoria     = array_search($c, $categorias_arreglo);
            $vinculo->nombre        = $p->nombre;
            $vinculo->descripcion   = $p->descripcion;
            $vinculo->imagen_previa = $p->imagen_previa;
            $vinculo->vinculo       = $p->url();
            $vinculo->region_nivel  = $p->region_nivel;
            $vinculo->creado        = $p->fecha;
            $vinculo->estatus       = 'A';
            switch ($p->directorio) {
                case 'blog':
                    $vinculo->tipo = 'A';
                    break;
                case 'indicadores-categorias':
                case 'indicadores-gomez-palacio':
                case 'indicadores-la-laguna':
                case 'indicadores-lerdo':
                case 'indicadores-matamoros':
                case 'indicadores-torreon':
                    $vinculo->tipo = 'I';
                    break;
                case 'sig-mapas-torreon':
                    $vinculo->tipo = 'G';
                    break;
                case 'proyectos':
                    $vinculo->tipo = 'P';
                    break;
                default:
                    $vinculo->tipo = 'O';
            }
            try {
                $vinculo->agregar();
            } catch (\Exception $e) {
                echo "$soy ERROR: ".$e->getMessage()."\n";
                exit($E_FATAL);
            }
            echo "  Nuevo vínculo \"{$vinculo->nombre}\" en la categoría {$categorias_arreglo[$vinculo->categoria]}\n";
        }
    }
}

// Mensaje de término
echo "$soy Programa terminado.\n";
exit($EXITO);

?>
