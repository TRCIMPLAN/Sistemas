<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorRegiones PorRegionesPHP
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

namespace SMILanzaderaPorRegiones;

/**
 * Clase PorRegionesPHP
 */
class PorRegionesPHP {

    protected $sesion;            // Instancia con la Sesión
    protected $espacio;           // Texto con el namespace
    protected $clase;             // Texto con el nombre de la clase
    protected $filtro_categorias; // Instancia de \SMILanzadera\FiltroCategorias

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion  = $in_sesion;
        $this->espacio = 'SMI';
        $this->clase   = 'PorRegiones';
    } // constructor

    /**
     * Definir filtro por categorias
     *
     * @param array Arreglo con textos
     */
    public function definir_filtro_categorias(FiltroCategorias $in_filtro) {
        $this->filtro_categorias = $in_filtro;
    } // definir_filtro_categorias

    /**
     * Método con el contenido de una región PHP
     *
     * @param  integer ID la región
     * @param  string  Nombre de la región
     * @return string  Código PHP
     */
    protected function seccion_region_php($region_id, $region_nombre) {
        // Cargar subíndices
        $subindices          = new \IndSubindices\Listado($this->sesion);
        $subindices->estatus = 'A';
        $subindices->consultar();
        // Iniciar arreglo donde acumular código HTML para el contenido de la lengüeta
        $a   = array();
        $a[] = '        <div class="row">';
        // Bucle por los Subíndices
        foreach ($subindices->listado as $s) {
            // Cargar indicadores del subíndice
            $indicadores            = new \IndIndicadores\Listado($this->sesion);
            $indicadores->estatus   = 'A';
            $indicadores->subindice = $s['id'];
            try {
                $indicadores->consultar();
            } catch (\Base2\ListadoExceptionVacio $e) {
                continue; // El subíndice NO tiene indicadores EN USO, se salta
            }
            // Acumular
            $a[] = '          <div class="col-md-2 indicadores-vinculos">';
            $a[] = "            <h3>{$s['nombre']}</h3>";
            $a[] = "            <ul>";
            // Bucle en Indicadores
            foreach ($indicadores->listado as $i) {
                // Si se definió el filtro por categorias
                if ($this->filtro_categorias instanceof \SMILanzadera\FiltroCategorias) {
                    if ($this->filtro_categorias->filtrar($i['categorias']) === FALSE) {
                        continue;
                    }
                }
                // Averigüar si el indicador tiene datos
                $datos            = new \IndIndicadoresDatos\Listado($this->sesion);
                $datos->estatus   = 'A';
                $datos->region    = $region_id;
                $datos->indicador = $i['id'];
                try {
                    $datos->consultar();
                } catch (\Base2\ListadoExceptionVacio $e) {
                    continue; // El indicador NO tiene datos, se salta
                }
                // Definir la ruta para el vínculo
                $ruta = sprintf('../indicadores-%s/%s-%s.html',
                    \Base2\UtileriasParaFormatos::caracteres_para_web($region_nombre),
                    \Base2\UtileriasParaFormatos::caracteres_para_web($s['nombre']),
                    \Base2\UtileriasParaFormatos::caracteres_para_web($i['nombre']));
                // Acumular
                $a[] = "              <li><a href=\"$ruta\" target=\"_blank\">{$i['nombre']}</a></li>";
            } //  bucle indicadores
            $a[] = "            </ul>";
            $a[] = '          </div>';
        } // bucle subíndices
        $a[] = '        </div>';
        // Definir variables de la entrega
        $metodo    = \Base2\UtileriasParaFormatos::caracteres_para_metodo("seccion $region_nombre html");
        $contenido = implode("\n", $a);
        // Entregar
        return <<<TERMINO
    /**
     * Seccion $region_nombre HTML
     *
     * @return string Código HTML
     */
    protected function $metodo() {
        return <<<FINAL
$contenido
FINAL;
    } // $metodo

TERMINO;
    } // seccion_region_php

    /**
     * Línea para acumular lengüetas PHP
     *
     * @param  string Nombre de la región
     * @return string Código PHP
     */
    protected function linea_lenguetas_php($region_nombre) {
        // Definir variables de la entrega
        $identificador = \Base2\UtileriasParaFormatos::caracteres_para_web("smi $region_nombre");
        $metodo        = \Base2\UtileriasParaFormatos::caracteres_para_metodo("seccion $region_nombre html");
        // Entregar
        return "        \$this->lenguetas->agregar('$identificador', '$region_nombre', \$this->$metodo());";
    } // linea_lenguetas_php

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo con esta publicación
     */
    public function ruta() {
        return sprintf('lib/%s/%s.php', $this->espacio, $this->clase);
    } // ruta

    /**
     * PHP
     *
     * @return string Código PHP
     */
    public function php() {
        // Cargar regiones
        $regiones = new \SMILanzadera\RegionesMetropolitanasListado($this->sesion);
        $regiones->consultar();
        // Iniciar arreglos donde acumular código
        $s = array();
        $l = array();
        // Bucle por Regiones
        foreach ($regiones->listado as $r) {
            $s[] = $this->seccion_region_php($r['id'], $r['nombre']);
            $l[] = $this->linea_lenguetas_php($r['nombre']);
        } // bucle regiones
        // Juntar
        $secciones_php = implode("\n", $s);
        $lenguetas_php = implode("\n", $l);
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

    protected \$lenguetas;

    /**
     * Constructor
     */
    public function __construct() {
        // Título y fecha
        \$this->nombre      = 'Indicadores por Región';
        \$this->fecha       = '2015-01-01T08:00'; // Fecha fija
        // El nombre del archivo a crear
        \$this->archivo     = 'por-region';
        // La descripción y claves dan información a los buscadores y redes sociales
        \$this->descripcion = 'Sistema Metropolitano de Indicadores: Encuentre los indicadores por región';
        \$this->claves      = 'IMPLAN, Torreon, Indicadores, Por Region';
        // Opción de navegación a poner como activa
        \$this->nombre_menu = 'Indicadores > Indicadores por Región';
        // Inicializar las lengüetas
        \$this->lenguetas   = new \\Base\\Lenguetas('smi-por-regiones');
    } // constructor

$secciones_php
    /**
     * HTML
     *
     * @return string Código HTML
     */
    public function html() {
        // Ejecutar los métodos que alimentan cada lengüeta
$lenguetas_php
        \$this->lenguetas->definir_activa(); // Primer lengüeta activa
        // Definir contenido HTML
        \$this->contenido = \$this->lenguetas->html();
        // Ejecutar este método en el padre
        return parent::html();
    } // html

    /**
     * Javascript
     *
     * @return string Código Javascript
     */
    public function javascript() {
        // JavaScript está dentro de las lengüetas
        \$this->javascript = \$this->lenguetas->javascript();
        // Ejecutar este método en el padre
        return parent::javascript();
    } // javascript

} // Clase {$this->clase}

?>

TERMINO;
    } // php

} // Clase PorRegionesPHP

?>
