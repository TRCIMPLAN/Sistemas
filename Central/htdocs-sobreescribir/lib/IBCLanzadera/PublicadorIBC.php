<?php
/**
 * TrcIMPLAN Central - IBCLanzadera PublicadorIBC
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

namespace IBCLanzadera;

/**
 * Clase PublicadorIBC
 *
 * Proceso principal que es ejecutado desde el script en bin
 */
class PublicadorIBC extends Publicador {

    // public $mensajes;
    // public $sitio_web_directorio;
    // protected $sesion;

    /**
     * Publicar
     *
     * @return string Mensajes para la terminal
     */
    public function publicar() {
        // Consultar regiones
        $regiones          = new \DagRegiones\Listado($this->sesion);
        $regiones->estatus = 'A';
        $regiones->consultar(); // id, nivel, nombre, nom_corto, estatus
        // Bucle por las regiones
        foreach ($regiones->listado as $r) {
            // Acumular mensaje
            $this->mensajes[] = "Región {$r['nombre']}";
            // Consultar región
            $region = new \DagRegiones\Registro($this->sesion);
            $region->consultar($r['id']);
            // Eliminar directorio y archivos
            $espacio = sprintf('IBCColonias%s', $region->nom_corto);
            $this->eliminar_directorio("lib/$espacio");
            // Consultar conglomerados de la región
            $conglomerados              = new \DagConglomerados\Listado($this->sesion);
            $conglomerados->region      = $r['id'];
            $conglomerados->visibilidad = 'V';
            $conglomerados->estatus     = 'A';
            $conglomerados->consultar();
            // Bucle por los conglomerados de la región
            $contador = 0;
            foreach ($conglomerados->listado as $c) {
                // Crear ficha
                $ficha_php          = new FichaPHP($this->sesion);
                $ficha_php->espacio = $espacio;
                try {
                    $ficha_php->consultar($c['id']);
                } catch (FichaExceptionSinDatos $e) {
                    $this->mensajes[] = sprintf('  SIN DATOS en %s, se omite.', $c['nom_corto']);
                    continue;
                } catch (\Exception $e) {
                    $this->mensajes[] = sprintf('  FALLÓ %s: %s', $c['nom_corto'], $e->getMessage());
                    continue;
                }
                $this->crear_archivo($ficha_php->ruta(), $ficha_php->php());
                $this->mensajes[] = sprintf('  %s / %s', $region->nombre, $c['nombre']);
                unset($ficha_php);
                $contador++;
            } // bucle conglomerados
            // Crear la imprenta para esta región si hubo fichas
            if ($contador > 0) {
                foreach (array('\\IBCLanzadera\\ElaboradorPHPImprenta', '\\IBCLanzadera\\ElaboradorPHPImprentaCSV', '\\IBCLanzadera\\ElaboradorPHPImprentaJSONs') as $objeto) {
                    $elaborador_php          = new $objeto($this->sesion);
                    $elaborador_php->region  = $region;
                    $elaborador_php->espacio = $espacio;
                    $this->crear_archivo($elaborador_php->ruta(), $elaborador_php->php());
                    $this->mensajes[]        = sprintf('  %s / %s', $region->nombre, $objeto);
                    unset($elaborador_php);
                }
            }
        } // bucle regiones
        // Entregar mensajes
        return implode("\n", $this->mensajes);
    } // publicar

} // Clase PublicadorIBC

?>
