<?php
/**
 * TrcIMPLAN Central - SIGLanzadera ElaboradorPHP
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
 * Clase abstracta ElaboradorPHP
 *
 * Para crear la Imprenta, ImprentaCSV e ImprentaJSONs
 */
abstract class ElaboradorPHP {

    public    $region;     // Instancia de \DagRegiones\Registro
    protected $sesion;     // Instancia de Sesion
    protected $espacio;    // Texto con el namespace
    protected $clase;      // Texto con el nombre de la clase
    protected $directorio; // Texto con el nombre del directorio en la raiz del sitio web

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // contructor

    /**
     * Validar
     */
    protected function validar() {
        // Validar región
        if (!is_object($this->region) || !($this->region instanceof \CatRegiones\Registro)) {
            throw new \Exception("Error en ElaboradorPHP: La propiedad region no es instancia de \\CatRegiones\\Registro.");
        }
        // Definir propiedades
        $this->espacio    = sprintf('SIGMapas%s',   \Base2\UtileriasParaFormatos::caracteres_para_clase($this->region->nombre));
        $this->clase      = 'Imprenta';
        $this->directorio = sprintf('sig-mapas-%s', \Base2\UtileriasParaFormatos::caracteres_para_web($this->region->nombre));
    } // validar

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo
     */
    public function ruta() {
        $this->validar();
        return sprintf('lib/%s/%s.php', $this->espacio, $this->clase);
    } // ruta

    abstract function php();

} // Clase abstracta ElaboradorPHP

?>
