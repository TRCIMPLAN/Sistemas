<?php
/**
 * TrcIMPLAN Central - Categorias Listado HTML
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

namespace IndCategorias;

/**
 * Clase ListadoHTML
 */
class ListadoHTML extends Listado {

    // public $listado;
    // public $cantidad_registros;
    // public $limit;
    // protected $offset;
    // protected $sesion;
    public $viene_listado;   // SE USA EN LA PAGINA, SI ES VERDADERO DEBE MOSTRAR EL LISTADO
    protected $estructura;
    protected $listado_controlado;
    protected $javascript = array();

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        // DEFINIR ESTRUCTURA
        $this->estructura = array(
            'nombre'   => array(
                'enca'    => 'Categoría',
                'pag'     => 'indmatriz.php',
                'param'   => array(
                    'categoria' => 'nombre')), // ESTO HACE EL VINCULO A indmatriz.php?categoria=Nombre
            'cantidad' => array(
                'enca'    => 'Cantidad'));
        // INICIAR LISTADO CONTROLADO HTML
        $this->listado_controlado = new \Base\ListadoControladoHTML();
        // SU CONSTRUCTOR TOMA ESTOS PARAMETROS POR URL
        $this->limit              = $this->listado_controlado->limit;
        $this->offset             = $this->listado_controlado->offset;
        $this->cantidad_registros = $this->listado_controlado->cantidad_registros;
        // EJECUTAR EL CONSTRUCTOR DEL PADRE
        parent::__construct($in_sesion);
    } // constructor

    /**
     * Barra
     *
     * @param  string Encabezado opcional
     * @return mixed  Instancia de BarraHTML
     */
    public function barra($in_encabezado='') {
        // SI VIENE EL ENCABEZADO COMO PARAMETRO
        if ($in_encabezado !== '') {
            // SE USA
            $encabezado = $in_encabezado;
        } else {
            // DE LO CONTRARIO SE TOMA EL DE LISTADO
            $encabezado = $this->encabezado();
        }
        // CREAR LA BARRA
        $barra             = new \Base\BarraHTML();
        $barra->encabezado = $encabezado;
        $barra->icono      = $this->sesion->menu->icono_en('ind_categorias');
        // BOTON DESCARGAR CSV
        $barra->boton_descargar("indcategorias.csv", $this->filtros_param, '<span class="glyphicon glyphicon-floppy-save"></span> CSV');
        // ENTREGAR LA BARRA
        return $barra;
    } // barra

    /**
     * HTML
     *
     * @param  string Encabezado opcional
     * @return string HTML
     */
    public function html($in_encabezado='') {
        // CONSULTAR
        try {
            $this->consultar();
        } catch (\Exception $e) {
            $mensaje = new \Base\MensajeHTML($e->getMessage());
            return $mensaje->html($this->encabezado());
        }
        // PASAMOS AL LISTADO CONTROLADO HTML
        $this->listado_controlado->estructura         = $this->estructura;
        $this->listado_controlado->listado            = $this->listado;
        $this->listado_controlado->panal              = $this->panal;
        $this->listado_controlado->cantidad_registros = $this->cantidad_registros;
        $this->listado_controlado->variables          = $this->filtros_param;
        $this->listado_controlado->limit              = $this->limit;
        $this->listado_controlado->barra              = $this->barra($in_encabezado);
        // PASAR EL JAVASCRIPT DEL LISTADO CONTROLADO
        $this->javascript[] = $this->listado_controlado->javascript();
        // ENTREGAR HTML
        return $this->listado_controlado->html();
    } // html

    /**
     * Javascript
     *
     * @return string Javascript, si no hay entrega falso
     */
    public function javascript() {
        if (is_array($this->javascript) && (count($this->javascript) > 0)) {
            $a = array();
            foreach ($this->javascript as $js) {
                if (is_string($js) && ($js != '')) {
                    $a[] = $js;
                }
            }
            if (count($a) > 0) {
                return implode("\n", $a);
            } else {
                return false;
            }
        } else {
            return false;
        }
    } // javascript

} // Clase ListadoHTML

?>
