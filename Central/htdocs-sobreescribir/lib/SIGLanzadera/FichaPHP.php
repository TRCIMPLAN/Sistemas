<?php
/**
 * TrcIMPLAN Central - SIGLanzadera FichaPHP
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
 * Clase FichaPHP
 *
 * Toma los datos del conglomerado y le da forma en código PHP
 */
class FichaPHP extends Ficha {

    // protected $sesion;
    // protected $consultado;
    // protected $mapa;
    // protected $autor;
    // protected $imprenta;
    // protected $region;
    protected $espacio; // Texto con el namespace
    protected $clase;   // Texto con el nombre de la clase

    /**
     * Consultar
     *
     * @param integer ID del Mapa
     */
    public function consultar($in_mapa_id=false) {
        // Ejecutar método en el padre
        parent::consultar($in_mapa_id);
        // Definir propiedades espacio y clase
        $this->espacio = sprintf('SIGMapas%s',   \Base2\UtileriasParaFormatos::caracteres_para_clase($this->region->nombre));
        $this->clase   = \Base2\UtileriasParaFormatos::caracteres_para_clase($this->mapa->nombre, true);
    } // consultar

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo con esta publicación
     */
    public function ruta() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Entregar
        return sprintf('lib/%s/%s.php', $this->espacio, $this->clase);
    } // ruta

    /**
     * PHP
     *
     * @return string Código PHP
     */
    public function php() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaPHP: No se ha consultado.");
        }
        // Definir variables
        $fecha      = \Base2\UtileriasParaFormatos::formato_fecha_hora($this->mapa->fecha, 'T');
        $archivo    = \Base2\UtileriasParaFormatos::caracteres_para_web($this->mapa->nombre, true);
        $directorio = $this->imprenta->directorio.'-'.\Base2\UtileriasParaFormatos::caracteres_para_web($this->region->nombre);
        // Definir imagen
        if ($this->mapa->imagen != '') {
            $imagen_linea = sprintf("\$this->imagen             = '%s/%s';", $archivo, $this->mapa->imagen);
        } else {
            $imagen_linea = "// Sin imagen";
        }
        // Definir imagen previa
        if ($this->mapa->imagen_previa != '') {
            $imagen_previa_linea = sprintf("\$this->imagen_previa      = '%s/%s';", $archivo, $this->mapa->imagen_previa);
        } else {
            $imagen_previa_linea = '// Sin imagen previa';
        }
        // Definir categorías
        if ($this->mapa->categorias != '') {
            $categorias_linea = sprintf("\$this->categorias         = %s;", $this->formato_arreglo_php($this->mapa->categorias));
        } else {
            $categorias_linea = '// Sin categorías';
        }
        // Definir para compartir
        if ($this->mapa->para_compartir == 'C') {
            $para_compartir = 'TRUE';
        } else {
            $para_compartir = 'FALSE';
        }
        // Definir tipo
        switch ($this->mapa->tipo) {
            case 'V':
                $tipo = 'VenueMap';
                break;
            case 'T':
                $tipo = 'TransitMap';
                break;
            case 'E':
                $tipo = 'ParkingMap';
                break;
            case 'S':
                $tipo = 'SeatingMap';
        }
        // Definir pantalla completa url
        if ($this->mapa->pantalla_completa_url != '') {
            $url_linea = sprintf("\$this->url                = '%s';", $this->mapa->pantalla_completa_url);
        } else {
            $url_linea = "// Sin URL";
        }
        // Definir pantalla completa etiqueta
        if ($this->mapa->pantalla_completa_etiqueta != '') {
            $url_etiqueta_linea = sprintf("\$this->url_etiqueta       = '%s';", $this->mapa->pantalla_completa_etiqueta);
        } else {
            $url_etiqueta_linea = "// Sin URL etiqueta";
        }
        // Definir caja html
        if ($this->mapa->caja_html != '') {
            $caja_html_linea = sprintf("\$mapa->theMap             = <<<FINAL\n%s\nFINAL;", $this->mapa->caja_html);
        } else {
            $caja_html_linea = "// Sin caja HTML";
        }
        // Definir caja js
        if ($this->mapa->caja_js != '') {
            $caja_js_linea = sprintf("\$this->javascript         = <<<FINAL\n%s\nFINAL;", $this->mapa->caja_js);
        } else {
            $caja_js_linea = "// Sin caja JS";
        }
        // Entregar
        return <<<TERMINO
<?php
/**
 * TrcIMPLAN Sitio Web - {$this->espacio} {$this->clase}
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
class {$this->clase} extends \\Base\\Publicacion {

    /**
     * Constructor
     */
    public function __construct() {
        // Título, autor y fecha
        \$this->nombre             = '{$this->mapa->nombre}';
        \$this->autor              = '{$this->autor->nombre}';
        \$this->fecha              = '$fecha';
        // El nombre del archivo a crear y rutas relativas a las imágenes
        \$this->archivo            = '$archivo';
        $imagen_linea
        $imagen_previa_linea
        // La descripción y claves dan información a los buscadores y redes sociales
        \$this->descripcion        = '{$this->mapa->descripcion}';
        \$this->claves             = '{$this->mapa->palabras_clave}';
        // El directorio en la raíz donde se guardará el archivo HTML
        \$this->directorio         = '$directorio';
        // Opción del menú Navegación a poner como activa cuando vea esta publicación
        \$this->nombre_menu        = '{$this->imprenta->nombre_menu}';
        // El estado puede ser publicar, revisar o ignorar
        \$this->estado             = '{$this->mapa->estado_descrito}';
        // Si para compartir es verdadero, aparecerán al final los botones de compartir en Twitter y Facebook
        \$this->para_compartir     = $para_compartir;
        // Para el Organizador
        $categorias_linea
        // Para el botón de ver a pantalla completa
        $url_linea
        $url_etiqueta_linea
        // Instancia de SchemaPostalAddress que tiene la localidad, municipio y país
        \$region                   = new \Base\SchemaPostalAddress();
        \$region->addressCountry   = '{$this->region->esquema_pais}';
        \$region->addressRegion    = '{$this->region->esquema_region}';
        \$region->addressLocality  = '{$this->region->esquema_localidad}';
        // Instancia de SchemaMapa con el mapa en CartoDB
        \$mapa                     = new \Base\SchemaMap();
        \$mapa->mapType            = '$tipo';
        \$mapa->url                = \$this->url;
        \$mapa->url_label          = \$this->url_etiqueta;
        $caja_html_linea
        // Instancia de SchemaPlace agrupa la región y el mapa
        \$lugar                    = new \Base\SchemaPlace();
        \$lugar->address           = \$region;
        \$lugar->hasMap            = \$mapa;
        // Instancia de SchemaCreativeWork lo empaca con más datos
        \$paquete                  = new \Base\SchemaCreativeWork();
        \$paquete->big_heading     = true;
        \$paquete->name            = \$this->nombre;
        \$paquete->description     = \$this->descripcion;
        \$paquete->author          = \$this->autor;
        \$paquete->datePublished   = \$this->fecha;
        \$paquete->headline_style  = \$this->encabezado_color;
        \$paquete->image           = \$this->imagen;
        \$paquete->contentLocation = \$lugar;
        // El contenido es una instancia de SchemaCreativeWork
        \$this->contenido          = \$paquete;
    } // constructor

    /**
     * Javascript
     *
     * @return string No hay código Javascript, entrega un texto vacío
     */
    public function javascript() {
        // JavaScript
        $caja_js_linea
        // Ejecutar este método en el padre
        return parent::javascript();
    } // javascript

    /**
     * Redifusion HTML
     *
     * @return string Código HTML
     */
    public function redifusion_html() {
        // Para redifusión, si tiene una imagen, se pone la imagen y después el contenido
        if (\$this->imagen != '') {
            \$this->redifusion = sprintf("<a href=\"%s\"><img src=\"%s\"><br>\\n\\n%s</a>", "{\$this->archivo}.html", \$this->imagen, \$this->descripcion);
        } else {
            \$this->redifusion = sprintf('<a href="%s">%s</a>', "{\$this->archivo}.html", \$this->descripcion);
        }
        // Ejecutar este método en el padre
        return parent::redifusion_html();
    } // redifusion_html

} // Clase {$this->clase}

?>

TERMINO;
    } // php

} // Clase FichaPHP

?>
