<?php

class ControleurBoutique{
    public function __construct(){}
    
    public function afficher(){
        require_once chemins::MODELES . 'gestion_produit.class.php';
        if (isset($_REQUEST['categorie']))
        {
            VariablesGlobales::$lesCategories = GestionCategorie::getLesCategorie();
            VariablesGlobales::$lesProduits = GestionProduit::getLesProduitsByCategorie($_REQUEST['categorie']);
        }
        else
        {
            
        }
            
        require_once chemins::VUES . 'v_boutique.inc.php';
    }    
}

