<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gestion_bdd
 *
 * @author masl
 */
class GestionBDD {
    
    // <editor-fold defaultstate="collapsed" desc="Champs statiques">

    /**
     * Objet de la classe PDO
     * @var PDo
     */
    private static $pdoCnxBase = null;

    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    private static $pdoStResults = null;
    private static $request = ""; //texte de la requête
    private static $result = null; //resultat de la requête

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">
    /**
     * Se connecte à la base précisé dans la classe mysql_config
     */
    public static function seConnecter() {
        if (!isset(self::$pdoCnxBase)) {
            try {               
                self::$pdoCnxBase = new PDO('mysql:host=' . MySqlConfig::NOM_SERVEUR . ';dbname=' . MySqlConfig::NOM_BASE, MySqlConfig::NOM_UTILISATEUR, MySqlConfig::MOT_DE_PASEE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                // l'objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // Méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // Méthode de la classe exception
            }
        }
    }
    
    /**
     *  Se déconnecte de la base en cours
     */
    public static function seDeconnecter() {
        self::$pdoCnxBase = null;
        //si on appelle pas la méthode, la déconnexion a lieu en fin de script
    }
    
    /**
     * Retourne tout les tuples d'une table
     * @param string Table à parcourir
     * @return type
     */
    public static function getLesTuples($table) {
        self::seConnecter();
        self::$request = "SELECT * FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetchAll();
        self::$pdoStResults->closeCursor();

        return self::$result;
    }
    
    /**
     * Retourne tout les tuples d'une liaison de deux tables
     * @param string $tableAParcourir
     * @param string $tableLiaison
     * @return type
     */
    public static function getLesTuplesSimpleJointure($tableAParcourir, $tableLiaison){
        self::seConnecter();
        self::$request = "SELECT * FROM $tableSource NATURAL JOIN $tableLiaison";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$result;
    }
    // </editor-fold>
}
