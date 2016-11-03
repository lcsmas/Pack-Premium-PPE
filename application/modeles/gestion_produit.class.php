<?php

class GestionProduit extends GestionBDD{
    
    /**
     * Retourne la liste des produits
     * @return type Tableau d'objets
     */
    public static function getLesProduits() {
        return self::getLesTuples('produit');
    } 
    
    public static function getLesProduitsByCategorie(){
        return self::getLesTuplesSimpleJointure('produit','categorie');
    }
}
