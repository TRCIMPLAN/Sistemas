<?php
/**
 * TrcIMPLAN Central - SMILanzaderaPorCategorias CategoriaPHP
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

namespace SMILanzaderaPorCategorias;

/**
 * Clase CategoriaPHP
 *
 * Elaborar código PHP para las publicaciones de las categorías del SMI
 */
class CategoriaPHP {

    protected $consultado = FALSE; // Verdadero si ya fue consultado
    protected $sesion;             // Instancia de \Inicio\Sesion
    protected $categoria;          // Texto, nombre de la categoría a filtrar
    protected $filtro_categorias;  // Instancia de FiltroCategorias
    protected $filtro_fuentes;     // Instancia de FiltroFuentes
    protected $filtro_regiones;    // Instancia de FiltroRegiones
    protected $espacio;            // Texto con el namespace
    protected $clase;              // Texto con el nombre de la clase
    static public $imagenes_previas = array(
        'Bienestar'                                    => '../imagenes/categorias/bienestar.jpg',
        'Competitividad'                               => '../imagenes/categorias/competitividad.jpg',
        'Cultura'                                      => '../imagenes/categorias/cultura.jpg',
        'Delincuencia'                                 => '../imagenes/categorias/delincuencia.jpg',
        'Doing Business'                               => '../imagenes/categorias/doing-business.jpg',
        'Educación'                                    => '../imagenes/categorias/educacion.jpg',
        'Empleo'                                       => '../imagenes/categorias/empleo.jpg',
        'Empresas'                                     => '../imagenes/categorias/empresas.jpg',
        'Finanzas Públicas'                            => '../imagenes/categorias/finanzas-publicas.jpg',
        'Género'                                       => '../imagenes/categorias/genero.jpg',
        'Gobierno Digital'                             => '../imagenes/categorias/gobierno-digital.jpg',
        'Gobierno'                                     => '../imagenes/categorias/gobierno.jpg',
        'Grupos Vulnerables'                           => '../imagenes/categorias/grupos-vulnerables.jpg',
        'Índice de Competitividad Urbana'              => '../imagenes/categorias/indice-de-competitividad-urbana.jpg',
        'Infraestructura'                              => '../imagenes/categorias/infraestructura.jpg',
        'Innovación'                                   => '../imagenes/categorias/innovacion.jpg',
        'Macroeconomía'                                => '../imagenes/categorias/macroeconomia.jpg',
        'Medio Ambiente'                               => '../imagenes/categorias/medio-ambiente.jpg',
        'Mercados'                                     => '../imagenes/categorias/mercados.jpg',
        'Movilidad'                                    => '../imagenes/categorias/movilidad.jpg',
        'Objetivos del Milenio'                        => '../imagenes/categorias/objetivos-del-milenio.jpg',
        'Participación Ciudadana'                      => '../imagenes/categorias/participacion-ciudadana.jpg',
        'Población'                                    => '../imagenes/categorias/poblacion.jpg',
        'Recursos Naturales'                           => '../imagenes/categorias/recursos-naturales.jpg',
        'Salud'                                        => '../imagenes/categorias/salud.jpg',
        'Sector Automotriz'                            => '../imagenes/categorias/sector-automotriz.jpg',
        'Seguridad'                                    => '../imagenes/categorias/seguridad.jpg',
        'Servicios Públicos'                           => '../imagenes/categorias/servicios-publicos.jpg',
        'Sistema de Indicadores de Desempeño (SINDES)' => '../imagenes/categorias/sistema-de-indicadores-de-desempeno-sindes.jpg',
        'Transparencia'                                => '../imagenes/categorias/transparencia.jpg',
        'Vialidad'                                     => '../imagenes/categorias/vialidad.jpg',
        'Vivienda'                                     => '../imagenes/categorias/vivienda.jpg');
    static public $icono_por_defecto         = 'fa fa-file-text-o';
    static public $imagen_previa_por_defecto = '../imagenes/categorias/por-defecto.jpg';

    /**
     * Constructor
     *
     * @param mixed Sesion
     */
    public function __construct(\Inicio\Sesion $in_sesion) {
        $this->sesion = $in_sesion;
    } // constructor

    /**
     * Consultar
     *
     * @param string Categoría a filtrar
     */
    public function consultar($in_categoria) {
        // Validar
        if ($in_categoria == '') {
            throw new \Exception("Categoría incorrecta.");
        }
        // Parámetro
        $this->categoria = $in_categoria;
        // Definir el espacio y la clase
        $this->espacio = 'SMICategorias';
        $this->clase   = \Base2\UtileriasParaFormatos::caracteres_para_clase($this->categoria);
        // Levantar bandera
        $this->consultado = TRUE;
    } // consultar

    /**
     * Definir filtro por categorias
     *
     * @param array Instancia de FiltroCategorias
     */
    public function definir_filtro_categorias($in_filtro) {
        if ($in_filtro instanceof \SMILanzadera\FiltroCategorias) {
            $this->filtro_categorias = $in_filtro;
        } else {
            $this->filtro_categorias = NULL;
        }
    } // definir_filtro_categorias

    /**
     * Definir filtro por fuentes
     *
     * @param array Instancia de FiltroFuentes
     */
    public function definir_filtro_fuentes($in_filtro) {
        if ($in_filtro instanceof \SMILanzadera\FiltroFuentes) {
            $this->filtro_fuentes = $in_filtro;
        } else {
            $this->filtro_fuentes = NULL;
        }
    } // definir_filtro_fuentes

    /**
     * Definir filtro por regiones
     *
     * @param array Instancia de FiltroRegiones
     */
    public function definir_filtro_regiones($in_filtro) {
        if ($in_filtro instanceof \SMILanzadera\FiltroRegiones) {
            $this->filtro_regiones = $in_filtro;
        } else {
            $this->filtro_regiones = NULL;
        }
    } // definir_filtro_regiones

    /**
     * Encabezado
     */
    public function encabezado() {
        if ($this->consultado == FALSE) {
            throw new \Exception("Error en CategoriaPHP: No se ha consultado.");
        }
        return $this->categoria;
    } // encabezado

    /**
     * Ruta
     *
     * @return string Ruta de destino para el archivo con esta publicación
     */
    public function ruta() {
        if ($this->consultado == FALSE) {
            throw new \Exception("Error en CategoriaPHP: No se ha consultado.");
        }
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
            throw new \Exception("Error en CategoriaPHP: No se ha consultado.");
        }
        // Elaborar Matriz
        $matriz = new MatrizPHP($this->sesion);
        $matriz->definir_filtro_categorias($this->filtro_categorias);
        $matriz->definir_filtro_fuentes($this->filtro_fuentes);
        $matriz->definir_filtro_regiones($this->filtro_regiones);
        $matriz->categoria = $this->categoria;
        try {
            $matriz->consultar();
            $matriz_php = $matriz->php();
        } catch (\Base2\ListadoExceptionVacio $e) {
            throw new \Exception("No hay indicadores en esta categoría. Debería de haber.");
        }
        // Elaborar Otras Regiones
        $otras = new OtrasPHP($this->sesion);
        $otras->definir_filtro_categorias($this->filtro_categorias);
        $otras->definir_filtro_fuentes($this->filtro_fuentes);
        $otras->definir_filtro_regiones($this->filtro_regiones);
        $otras->categoria = $this->categoria;
        try {
            $otras->consultar();
            $otras_php = $otras->php();
        } catch (\Base2\ListadoExceptionVacio $e) {
            $otras_php = '';
        }
        // Variables
        $titulo        = $this->encabezado();
        $descripcion   = "Sistema Metropolitano de Indicadores: Categoría {$this->categoria}. En PC, mantenga el ratón sobre un dato por unos segundos para mostrar la unidad, fecha y fuente. De clic para ir a la página con la información detallada del indicador.";
        $archivo       = \Base2\UtileriasParaFormatos::caracteres_para_web($this->categoria);
        if (isset(self::$imagenes_previas[$this->categoria])) {
            $imagen        = self::$imagenes_previas[$this->categoria];
            $imagen_previa = $imagen;
            $imagen_id     = 'categorias-'.$archivo;
        } else {
            $imagen        = self::$imagen_previa_por_defecto;
            $imagen_previa = $imagen;
            $imagen_id     = 'categorias-por-defecto';
        }
        $directorio    = 'indicadores-categorias';
        $nombre_menu   = 'Indicadores > Indicadores por Categoría';
        $claves        = "'IMPLAN, Indicadores, Categoría, {$this->categoria}'";
        $categorias    = "array()";
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
        // Ejecutar constructor en el padre
        parent::__construct();
        // Título y fecha
        \$this->nombre        = '$titulo';
        \$this->fecha         = '2015-01-01T08:00'; // Fecha fija
        // El nombre del archivo a crear
        \$this->archivo       = '$archivo';
        // La descripción y claves dan información a los buscadores y redes sociales
        \$this->descripcion   = '$descripcion';
        \$this->claves        = $claves;
        // Rutas relativas a las imágenes, apuntan a íconos interactivos para cada categoría
        \$this->imagen        = '$imagen';
        \$this->imagen_previa = '$imagen_previa';
        \$this->imagen_id     = '$imagen_id';
        // Para el Organizador
        \$this->categorias    = $categorias;
        \$this->fuentes       = array();
        \$this->regiones      = array();
        // Iniciar el contenido que será un SchemaArticle
        \$this->contenido = new \Base\SchemaArticle();
    } // constructor

    /**
     * HTML
     *
     * @return string Código HTML
     */
    public function html() {
        // Definir propiedades del contenido que es un SchemaArticle
        \$this->contenido->big_heading   = TRUE;
        \$this->contenido->headline      = \$this->nombre;
        \$this->contenido->description   = \$this->descripcion;
        \$this->contenido->author        = \$this->autor;
        \$this->contenido->datePublished = \$this->fecha;
        \$this->contenido->image         = \$this->imagen;
        \$this->contenido->image_show    = \$this->poner_imagen_en_contenido;
        \$this->contenido->articleBody   = <<<FINAL
$matriz_php
$otras_php
FINAL;
        // Entregar
        return parent::html();
    } // html

    /**
     * Javascript
     *
     * @return string Código Javascript
     */
    public function javascript() {
        // JavaScript
        \$this->javascript = <<<FINAL
FINAL;
        // Ejecutar este método en el padre
        return parent::javascript();
    } // javascript

    /**
     * Redifusion HTML
     *
     * @return string Código HTML
     */
    public function redifusion_html() {
        // Código HTML para redifusión
        \$this->redifusion = \$this->descripcion;
        // Ejecutar este método en el padre
        return parent::redifusion_html();
    } // redifusion_html

} // Clase {$this->clase}

?>

TERMINO;
    } // php

} // Clase CategoriaPHP

?>
