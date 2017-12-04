<?php
/**
 * TrcIMPLAN Central - SMILanzadera ElaboradorPHP
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

namespace SMILanzadera;

/**
 * Clase abstracta ElaboradorPHP
 *
 * Para crear la Imprenta, ImprentaCSV e ImprentaJSONs
 */
abstract class ElaboradorPHP {

    protected $sesion;     // Instancia de Sesion
    protected $region;     // Instancia de \CatRegiones\Registro
    protected $espacio;    // Debe definir el namespace
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
     * Definir región
     *
     * @param mixed Instancia de \CatRegiones\Registro
     */
    public function definir_region(\CatRegiones\Registro $in_region) {
        $this->region = $in_region;
    } // definir_region

    /**
     * Definir espacio
     *
     * @param string Texto con el namespace
     */
    public function definir_espacio($in_espacio) {
        $this->espacio = $in_espacio;
    } // definir_espacio

    /**
     * Validar
     */
    protected function validar() {
        // Validar región
        if (($this->region->consultado != TRUE) || ($this->region->estatus != 'A')) {
            throw new \Exception("Error en ElaboradorPHP: La instancia Region no está consultada o no está en uso.");
        }
        // Verificar que esté definido el espacio
        if (!\Base2\UtileriasParaValidar::validar_clase($this->espacio)) {
            throw new \Exception("Error en ElaboradorPHP: No se ha definido la propiedad espacio.");
        }
        // Definir propiedades
        $this->directorio = sprintf('indicadores-%s', \Base2\UtileriasParaFormatos::caracteres_para_web($this->region->nombre));
        $this->clase      = 'Imprenta';
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
