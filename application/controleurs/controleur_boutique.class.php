<?php

class ControleurBoutique{
    public function __construct(){}
    
    public function afficher(){
        VariablesGlobales::$lesCategories = GestionCategorie::getLesCategorie();
        require_once chemins::VUES . 'v_boutique.inc.php';
    }
}

