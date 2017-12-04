<?php
/**
 * TrcIMPLAN Central - IBCLanzadera ElaboradorPHPImprenta
 *
 * Copyright (C) 2017 Guillermo Valdés Lozano
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

namespace IBCLanzadera;

/**
 * Clase ElaboradorPHPImprenta
 *
 * Elabora el archivo Imprenta.php
 */
class ElaboradorPHPImprenta extends ElaboradorPHP {

    // public    $region;
    // protected $sesion;
    // protected $espacio;
    // protected $clase;
    // protected $directorio;

    /**
     * PHP
     *
     * @return string Código PHP
     */
    public function php() {
        // Validar
        $this->validar();
        // Entregar
        return <<<CONTENIDO
<?php
/**
 * TrcIMPLAN Sitio Web - Imprenta
 *
 * Copyright (C) 2017 Guillermo Valdés Lozano <guivaloz@movimientolibre.com>
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
 * @package TrcIMPLANSitioWeb
 */

namespace {$this->espacio};

/**
 * Clase {$this->clase}
 */
class {$this->clase} extends \\Base\\ImprentaPublicaciones {

    /**
     * Constructor
     */
    public function __construct() {
        // Nombre del directorio dentro de /lib que contiene los archivos con las publicaciones
        \$this->publicaciones_directorio  = '{$this->espacio}';
        // Los siguientes parámetros dan datos para el índice/galería que será creado
        \$this->titulo                    = 'Colonias de {$this->region->nombre}';
        \$this->descripcion               = 'Indicadores Básicos de Colonias de {$this->region->nombre}, Coahuila de Zaragoza, México.';
        \$this->claves                    = 'IMPLAN, Torreon, Indicadores, Colonias, {$this->region->nombre}';
        // Parámetros que el Recolector definirá en las Publicaciones si éstas no los tienen
        \$this->aparece_en_pagina_inicial = FALSE;
        \$this->autor                     = 'Dirección de Investigación Estratégica';
        \$this->para_compartir            = FALSE;
        \$this->imagen                    = '../imagenes/imagen.jpg';
        \$this->imagen_previa             = '../imagenes/imagen-previa.jpg';
        \$this->poner_imagen_en_contenido = FALSE;
        \$this->nombre_menu               = 'Indicadores Básicos de Colonias > Colonias de {$this->region->nombre}';
        // Ruta a la clase para hacer la página con el índice
        \$this->indices_paginas           = '\\\\Base\\\\PaginasListadoAlfabetico';
        // Directorio en la raíz que será creado para alojar el concentrador y las páginas
        \$this->directorio                = '{$this->directorio}';
        // Nivel es el orden de la rama para los índices por autores y categorías, debe ser un entero grande
        \$this->nivel                     = 80000;
        // Ejecutar constructor en el padre
        parent::__construct();
    } // constructor

} // Clase {$this->clase}

?>

CONTENIDO;
    } // php

} // Clase ElaboradorPHPImprenta

?>
