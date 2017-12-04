<?php
/**
 * Serpiente - Central
 *
 * Copyright (C) 2017 Guillermo Valdes Lozano guillermo@movimientolibre.com
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
 * @package TrcIMPLAN
 */

namespace Semillas;

/**
 * Clase Serpiente
 */
class Serpiente extends \Arbol\Serpiente {

    // protected $sistema_nombre;
    // protected $sistema_siglas;
    // protected $reptil;

    /**
     * Constructor
     */
    public function __construct() {
        // Cargar nombre y siglas del sistema
        $this->sistema_nombre = 'TrcIMPLAN Central';
        $this->sistema_siglas = 'CEN';
        // Cargar Indicadores
        $this->reptil['CatFuentes']                  = Adan0131CatFuentes::$reptil;
        $this->reptil['CatRegiones']                 = Adan0135CatRegiones::$reptil;
        $this->reptil['CatUnidades']                 = Adan0139CatUnidades::$reptil;
        $this->reptil['IndSubindices']               = Adan0151IndSubindices::$reptil;
        $this->reptil['IndSubindicesPesos']          = Adan0153IndSubindicesPesos::$reptil;
        $this->reptil['IndIndicadores']              = Adan0161IndIndicadores::$reptil;
        $this->reptil['IndIndicadoresMapas']         = Adan0163IndIndicadoresMapas::$reptil;
        $this->reptil['IndIndicadoresDatos']         = Adan0165IndIndicadoresDatos::$reptil;
        // Cargar Categorías
        $this->reptil['CatCategorias']               = Adan0241CatCategorias::$reptil;
        $this->reptil['CatCategoriasVinculos']       = Adan0243CatCategoriasVinculos::$reptil;
        // Cargar Investigaciones
        $this->reptil['CatInvestigacionesCalidades'] = Adan0341CatInvestigacionesCalidades::$reptil;
        $this->reptil['CatInvestigacionesFuentes']   = Adan0343CatInvestigacionesFuentes::$reptil;
        $this->reptil['CatInvestigacionesAlcances']  = Adan0345CatInvestigacionesAlcances::$reptil;
        $this->reptil['InvInvestigaciones']          = Adan0371InvInvestigaciones::$reptil;
        // Cargar Proyectos
        $this->reptil['ProCriterios']                = Adan0421ProCriterios::$reptil;
        $this->reptil['ProFactores']                 = Adan0423ProFactores::$reptil;
        $this->reptil['ProEvaluadores']              = Adan0441ProEvaluadores::$reptil;
        $this->reptil['ProResponsables']             = Adan0447ProResponsables::$reptil;
        $this->reptil['ProProyectos']                = Adan0451ProProyectos::$reptil;
        $this->reptil['ProProyectosCalificaciones']  = Adan0453ProProyectosCalificaciones::$reptil;
        // Cargar SIG
        $this->reptil['SigAutores']                  = Adan0611SigAutores::$reptil;
        $this->reptil['SigImprentas']                = Adan0621SigImprentas::$reptil;
        $this->reptil['SigMapas']                    = Adan0651SigMapas::$reptil;
        // Cargar Organizador
        $this->reptil['OrgArboles']                  = Adan0711OrgArboles::$reptil;
        $this->reptil['OrgRamas']                    = Adan0713OrgRamas::$reptil;
        $this->reptil['OrgVinculos']                 = Adan0715OrgVinculos::$reptil;
        $this->reptil['OrgAutores']                  = Adan0721OrgAutores::$reptil;
        $this->reptil['OrgCategorias']               = Adan0731OrgCategorias::$reptil;
        $this->reptil['OrgRegiones']                 = Adan0741OrgRegiones::$reptil;
        $this->reptil['OrgFuentes']                  = Adan0751OrgFuentes::$reptil;
        $this->reptil['OrgElementos']                = Adan0791OrgElementos::$reptil;
        // Cargar Desagregación
        $this->reptil['DagEjes']                     = Adan0811DagEjes::$reptil;
        $this->reptil['DagCatalogos']                = Adan0813DagCatalogos::$reptil;
        $this->reptil['DagEntidades']                = Adan0821DagEntidades::$reptil;
        $this->reptil['DagMunicipios']               = Adan0823DagMunicipios::$reptil;
        $this->reptil['DagLocalidades']              = Adan0825DagLocalidades::$reptil;
        $this->reptil['DagAgebs']                    = Adan0827DagAgebs::$reptil;
        $this->reptil['DagManzanas']                 = Adan0829DagManzanas::$reptil;
        $this->reptil['DagManzanasComponentes']      = Adan0831DagManzanasComponentes::$reptil;
        $this->reptil['DagRegiones']                 = Adan0851DagRegiones::$reptil;
        $this->reptil['DagConglomerados']            = Adan0853DagConglomerados::$reptil;
        $this->reptil['DagConglomeradosManzanas']    = Adan0855DagConglomeradosManzanas::$reptil;
    } // constructor

} // Clase Serpiente

?>
