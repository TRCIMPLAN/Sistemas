<?php
/**
 * TrcIMPLAN Central - IBCLanzadera Ficha
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
 * Clase Ficha
 *
 * Consulta un conglomerado, refina los datos con apayo de la clase Dato
 */
class Ficha extends \Base2\Registro {

    // protected $sesion;
    // protected $consultado;
    protected $catalogos;       // Instancia de \DagCatalogos\Listado
    protected $conglomerado;    // Instancia de \DagConglomerados\Registro
    protected $procesados;      // Arreglo asociativo con instancias de Dato
    const     FECHA = '2010';   // La fecha es fija, en una próxima versión será cambiante

    /**
     * Consultar
     *
     * @param integer ID del Conglomerado
     */
    public function consultar($in_conglomerado_id=false) {
        // Si YA se ha consultado, no hace nada
        if ($this->consultado) {
            return;
        }
        // Consultar Conglomerado
        $this->conglomerado = new \DagConglomerados\Registro($this->sesion);
        $this->conglomerado->consultar($in_conglomerado_id);
        // Consultar Catálogos
        $this->catalogos          = new \DagCatalogos\Listado($this->sesion);
        $this->catalogos->estatus = 'A';
        $this->catalogos->consultar();
        // Iniciar arreglo asociativo que tendrá instancias de DesagregacionesDato
        $this->procesados = array();
        // Bucle por el listado de Catálogos
        foreach ($this->catalogos->listado as $c) {
            // Si es oculto se salta
            if ($c['visibilidad'] == 'O') {
                continue;
            }
            // Definir propiedad, es el nombre de la variable
            $propiedad = strtolower($c['nom_corto']);
            // Si se tiene el dato del catálogo en el conglomerado
            if (isset($this->conglomerado->$propiedad)) {
                $valor = $this->conglomerado->$propiedad;
            } else {
                continue;
            }
            // Se va a usar mucho
            $llave = $c['nivel'];
            // Iniciar nueva instancia
            $this->procesados[$llave] = new Dato();
            // De acuerdo al tipo de dato, según el catálogo
            switch ($c['dato_tipo']) {
                case 'E':
                    $this->procesados[$llave]->agregar_cantidad($valor, self::FECHA);
                    break;
                case 'D':
                    $this->procesados[$llave]->agregar_decimal($valor, self::FECHA);
                    break;
                case 'M':
                    $this->procesados[$llave]->agregar_dinero($valor, self::FECHA);
                    break;
                case 'P':
                    $this->procesados[$llave]->agregar_porcentaje($valor, self::FECHA);
                    break;
                case 'C':
                    $this->procesados[$llave]->agregar_caracter($valor, self::FECHA);
                    break;
                case 'S':
                    $this->procesados[$llave]->agregar_texto($valor, self::FECHA);
                    break;
                default:
            }
        } // Bucle por el listado de Catálogos
        // Si no hay datos
        if (count($this->procesados) == 0) {
            throw new FichaExceptionSinDatos("Aviso: No hay datos en el Conglomerado {$this->conglomerado->nombre}");
        }
        // Levantar la bandera
        $this->consultado = true;
    } // consultar

    /**
     * Encabezado
     *
     * @return string Encabezado
     */
    public function encabezado() {
        return 'Ficha';
    } // encabezado

} // Clase Ficha

?>
