<?php
/**
 * TrcIMPLAN Central - PublicacionConfig
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

namespace Configuracion;

/**
 * Clase abstracta PublicacionConfig
 *
 * Configuración para (alguna) lanzadera, son valores por defecto para cada publicación
 */
abstract class PublicacionConfig {

    public $fecha                     = '1980-01-01'; // La fecha en forma de YYYY-MM-DD HH:MM, siendo así se ordena cronológicamente
    public $autor                     = 'TrcIMPLAN';  // El nombre o apodo a quien se le atribuye
    public $aparece_en_pagina_inicial = true;         // Verdadero si va aparecer en la página de inicio
    public $para_compartir            = true;         // Si es verdadero pondrá los botones para compartir en Twitter/Facebook
    public $imagen_previa             = '';           // Ruta relativa a un archivo de imagen para la vista previa
    public $icono                     = '';           // Nombre del icono Font Awsome
    public $estado                    = 'publicar';   // El estado ordena a Imprenta e Índice si debe 'publicar', 'revisar' o 'ignorar'

    /**
     * Constructor
     */
    public function __construct() {
        // AlimentarPublicaciones carga todas las publiacaciones de trcimplan.github.io
        // Algunas publicaciones, en su contructor, llaman a parent::__constrcut
        // Este constructor no hace nada, pero cumple con la función de no provocar error por ausencia
    } // constructor

} // Clase abstracta PublicacionConfig

?>
