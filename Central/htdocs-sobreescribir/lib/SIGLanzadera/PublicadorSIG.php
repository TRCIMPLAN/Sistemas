<?php
/**
 * TrcIMPLAN Central - SIGLanzadera PublicadorSIG
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
 * Clase PublicadorSIG
 *
 * Proceso principal que es ejecutado desde el script en bin
 */
class PublicadorSIG extends Publicador {

    // public $mensajes;
    // public $sitio_web_directorio;
    // protected $sesion;

    /**
     * Publicar
     *
     * @return string Mensajes para la terminal
     */
    public function publicar() {
        // Consultar las regiones metropolitanas
        $regiones = new RegionesMetropolitanasListado($this->sesion);
        $regiones->consultar();
        // Bucle por las regiones
        foreach ($regiones->listado as $r) {
            // Acumular mensaje
            $this->mensajes[] = "Región {$r['nombre']}";
            // Consultar región
            $region = new \CatRegiones\Registro($this->sesion);
            $region->consultar($r['id']);
            // Eliminar directorio y archivos
            $espacio = sprintf('SIGMapas%s', \Base2\UtileriasParaFormatos::caracteres_para_clase($region->nombre));
            $this->eliminar_directorio("lib/$espacio");
            // Consultar los mapas de la región
            $mapas          = new \SigMapas\Listado($this->sesion);
            $mapas->region  = $r['id'];
            $mapas->estatus = 'A';
            try {
                $mapas->consultar();
            } catch (\Base2\ListadoExceptionVacio $e) {
                continue; // No hay mapas en la región y EN USO, se salta
            }
            // Bucle por los mapas de la región
            $contador = 0;
            foreach ($mapas->listado as $m) {
                // Crear ficha
                $ficha_php = new FichaPHP($this->sesion);
                try {
                    $ficha_php->consultar($m['id']);
                } catch (\Exception $e) {
                    $this->mensajes[] = sprintf('  FALLÓ %s: %s', $m['nombre'], $e->getMessage());
                    continue;
                }
                $this->crear_archivo($ficha_php->ruta(), $ficha_php->php());
                $this->mensajes[] = sprintf('  %s / %s', $region->nombre, $m['nombre']);
                unset($ficha_php);
                $contador++;
            } // bucle mapas
            // Crear la imprenta para esta región si hubo fichas
            if ($contador > 0) {
                $elaborador_php         = new ElaboradorPHPImprenta($this->sesion);
                $elaborador_php->region = $region;
                $this->crear_archivo($elaborador_php->ruta(), $elaborador_php->php());
                $this->mensajes[]       = sprintf('  %s / Imprenta', $region->nombre);
                unset($elaborador_php);
            }
        } // bucle regiones
        // Entregar mensajes
        return implode("\n", $this->mensajes);
    } // publicar

} // Clase PublicadorSIG

?>
