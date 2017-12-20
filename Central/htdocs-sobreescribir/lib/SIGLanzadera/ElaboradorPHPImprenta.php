<?php
/**
 * TrcIMPLAN Central - SIGLanzadera ElaboradorPHPImprenta
 *
 * Copyright (C) 2016 Guillermo Valdés Lozano
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

namespace SIGLanzadera;

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
class {$this->clase} extends \\Base\\ImprentaPublicacionesClasificadasPorCategorias {

    /**
     * Constructor
     */
    public function __construct() {
        // Nombre del directorio dentro de /lib que contiene los archivos con las publicaciones
        \$this->publicaciones_directorio  = '{$this->espacio}';
        // Los siguientes parámetros dan datos para el índice/galería que será creado
        \$this->titulo                    = 'Sistema de Información Geográfica de {$this->region->nombre}';
        \$this->descripcion               = 'Mapas con información georreferenciada de {$this->region->nombre}.';
        \$this->claves                    = 'IMPLAN, SIG, Información, Geográfica, {$this->region->nombre}';
        // Parámetros que el Recolector definirá en las Publicaciones si éstas no los tienen
        \$this->aparece_en_pagina_inicial = TRUE;
        \$this->autor                     = 'Dirección de Planeación Urbana Sustentable';
        \$this->para_compartir            = TRUE;
        \$this->imagen                    = '../imagenes/imagen.jpg';
        \$this->imagen_previa             = '../imagenes/imagen-previa.jpg';
        \$this->poner_imagen_en_contenido = FALSE;
        \$this->nombre_menu               = 'Información Geográfica > Mapas de Torreón';
        // Ruta a la clase para hacer la página con el índice
        \$this->indices_paginas           = '\\\\Base\\\\PaginasTarjetas';
        // Directorio en la raíz que será creado para alojar el concentrador y las páginas
        \$this->directorio                = '{$this->directorio}';
        // Pasar a la PaginasTarjetas estos parámetros
        \$this->ultimas_encabezado        = 'Últimos mapas del SIG Torreón';
        \$this->ultimas_vinculos          = '\\\\Base\\\\VinculosTarjetas';
        \$this->ultimas_cantidad          = 8;
        \$this->categorias_encabezado     = 'Todos los mapas clasificados por categorías';
        \$this->categorias_vinculos       = '\\\\Base\\\\VinculosCompactos';
        // Nivel es el orden de la rama para los índices por autores y categorías, debe ser grande
        \$this->nivel                     = 30000;
        // Ejecutar constructor en el padre
        parent::__construct();
    } // constructor

} // Clase {$this->clase}

?>

CONTENIDO;
    } // php

} // Clase ElaboradorPHPImprenta

?>
