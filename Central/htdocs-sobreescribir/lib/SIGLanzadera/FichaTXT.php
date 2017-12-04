<?php
/**
 * TrcIMPLAN Central - SIGLanzadera FichaTXT
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
 * Clase FichaTXT
 *
 * Toma los datos del conglomerado y le da forma en texto
 */
class FichaTXT extends Ficha {

    // protected $sesion;
    // protected $consultado;
    // protected $mapa;
    // protected $autor;
    // protected $imprenta;
    // protected $region;

    /**
     * TXT
     *
     * @return string Texto
     */
    public function txt() {
        // Validar que se haya consultado
        if (!$this->consultado) {
            throw new \Exception("Error en FichaTXT: No se ha consultado.");
        }
        // Definir variables
        $titulo  = sprintf('%s/%s.php', $this->imprenta->publicaciones_directorio, \Base2\UtileriasParaFormatos::caracteres_para_clase($this->mapa->nombre, true));
        $archivo = \Base2\UtileriasParaFormatos::caracteres_para_web($this->mapa->nombre, true);
        // Acumularemos la entrega en este arreglo
        $a   = array();
        $a[] = $titulo;
        $a[] = str_repeat('=', mb_strlen($titulo));
        $a[] = 'Título, autor y fecha.';
        $a[] = sprintf('  Nombre:         %s',    $this->mapa->nombre);
        $a[] = sprintf('  Autor:          %s',    $this->autor->nombre);
        $a[] = sprintf('  Fecha:          %s',    \Base2\UtileriasParaFormatos::formato_fecha_hora($this->mapa->fecha, 'T'));
        $a[] = 'Nombre del archivo a crear y las rutas relativas a las imágenes.';
        $a[] = sprintf('  Archivo:        %s',    $archivo);
        $a[] = sprintf('  Imagen:         %s/%s', $archivo, $this->mapa->imagen);
        $a[] = sprintf('  Imagen previa:  %s/%s', $archivo, $this->mapa->imagen_previa);
        $a[] = 'La descripción y claves dan información a los buscadores y redes sociales. Las categorías son de uso interno.';
        $a[] = sprintf('  Descripción:    %s',    $this->mapa->descripcion);
        $a[] = sprintf('  Palabras clave: %s',    $this->mapa->palabras_clave);
        $a[] = sprintf('  Categorías:     %s',    $this->formato_arreglo_php($this->mapa->categorias));
        $a[] = 'El nombre del directorio en la raíz del sitio donde se escribirá el archivo HTML';
        $a[] = sprintf('  Directorio:     %s',    $this->imprenta->directorio);
        $a[] = 'Opción del menú Navegación a poner como activa cuando vea esta publicación';
        $a[] = sprintf('  Nombre menú:    %s',    $this->imprenta->nombre_menu);
        $a[] = 'El estado puede ser publicar, revisar o ignorar';
        $a[] = sprintf('  Estado:         %s',    $this->mapa->estado_descrito);
        $a[] = 'Al compartir aparecerán al final los botones de compartir en Twitter y Facebook';
        $a[] = sprintf('  Para compartir: %s',    $this->mapa->para_compartir_descrito);
        $a[] = 'Para el botón de ver a pantalla completa';
        $a[] = sprintf('  URL:            %s',    $this->mapa->pantalla_completa_url);
        $a[] = sprintf('  URL etiqueta:   %s',    $this->mapa->pantalla_completa_etiqueta);
        // Entregar
        return "\n".implode("\n", $a)."\n";
    } // txt

} // Clase FichaTXT

?>
