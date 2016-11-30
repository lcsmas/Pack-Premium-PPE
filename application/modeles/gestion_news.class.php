<?php

/**
 * Contient tous les services de gestion de la boutique
 */
class GestionNews {
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
     * Retourne la liste des catégorie
     * @return type Tableau d'objets
     */
    public static function getLesNews() {
        self::seConnecter();
        self::$request = "SELECT * FROM news";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$result;
    }

    /**
     * Retourne la liste des produits
     * @return type Tableau d'objets
     */
    public static function getLesProduits() {
        self::seConnecter();
        self::$request = "SELECT * FROM Produit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$result;
    }

    /**
     * Retourne la liste des produits dans une catégorie
     * @param type Libelle de la catégorie
     * @return type Tableau de produit 
     */
    public static function getLesProduitsByCategorie($libelleCateg) {
        self::seConnecter();
        self::$request = "SELECT * FROM Produit P, Categorie C WHERE C.id = P.idCategorie and C.libelle = :libCateg";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->bindValue('libCateg', $libelleCateg);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$result;
    }

    /**
     * Retourne un objet produit grâce à son ID
     * @param type $idProduit
     * @return type Un objet produit
     */
    public static function getProduitsByID($idProduit) {
        self::seConnecter();
        self::$request = "SELECT * FROM Produit WHERE id= :idProd";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->bindValue('idProd', $idProduit);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$result;
    }

    /**
     * Retourne le nombre de produits présent dans la base de données
     * @return type String
     */
    public static function getNbProduits() {
        self::seConnecter();
        self::$request = "SELECT Count(*) as nbProduits FROM Produit";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$result->nbProduits;
    }

    /**
     * Ajoute un produit à la BDD
     * @param type Nom du produit
     * @param type Description du produit
     * @param type Prix du produit
     * @param type Image du produit
     * @param type ID de la catégorie du produit
     */
    public static function ajouterNews($contenu, $titre, $date) {
        self::seConnecter();
        try {
            self::$request = "INSERT INTO news(contenu,titre,date) values(:contenu,:titre,:date)";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('contenu', $contenu);
            self::$pdoStResults->bindValue('titre', $titre);
            self::$pdoStResults->bindValue('date', $date);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Ajoute une catégorie à la BDD
     * @param type Libelle de la catégorie
     */
    public static function ajouterCategorie($libelleCateg) {
        self::seConnecter();

        self::$request = "INSERT INTO Categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }

    /**
     * Modifie une catégorie de la BDD
     * @param type ID de la catégorie 
     * @param type libelle de la catégorie
     */
    public static function modifierCategorie($idCategorie, $libelleCateg) {
        self :: seConnecter();
        try {
            self::$request = "UPDATE Categorie SET libelle= :libelleCateg WHERE id= :idCateg";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('idCateg', $idCategorie);
            self::$pdoStResults->bindValue('libelleCateg', $libelleCateg);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Modifie un produit de la BDD
     * @param type ID du produit 
     * @param type Nom du produit
     * @param type Description du produit
     * @param type Prix du produit
     * @param type Image du produit 
     * @param type ID de la catégorie du produit 
     */
    public static function modifierProduit($id, $nom, $description, $prix, $image, $idCategorie) {
        self :: seConnecter();
        try {
            self::$request = "UPDATE Produit SET id= :id, nom=:nom, description= :description, prix= :prix, image= :image, idCategorie= :idCategorie WHERE id= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->bindValue('nom', $nom);
            self::$pdoStResults->bindValue('description', $description);
            self::$pdoStResults->bindValue('prix', $prix);
            self::$pdoStResults->bindValue('image', $image);
            self::$pdoStResults->bindValue('idCategorie', $idCategorie);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Supprime un produit de la BDD
     * @param type ID du produit
     */
    public static function deleteNews($idnews) {
        self::seConnecter();
        try {
            self::$request = "DELETE FROM news WHERE idnews= :idnews";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('idnews', $idnews);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Supprime une catégorie de la BDD
     * @param type ID de la catégorie
     */
    public static function deleteCategorie($id) {
        self::seConnecter();
        try {
            self::$request = "DELETE FROM Produit WHERE idCategorie= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->execute();

            self::$request = "DELETE FROM Categorie WHERE id= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Retourne tous les tuples de la table en paramètre
     * @param type Nom de la table dans la BDD
     * @return type Tous les tuples de la table
     */
    public static function getAllFrom($table) {
        self::seConnecter();
        try {
            self::$request = "SELECT * FROM " . $table;
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->execute();
            self::$result = self::$pdoStResults->fetchAll();

            self::$pdoStResults->closeCursor();

            return self::$result;
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Retourne le tuple correspondant a la valeur d'ID d'une table (id et table sont passés en paramètres
     * @param type Nom de la table
     * @param type ID de la table
     * @return type objet correspondant au tuple de la table
     */
    public static function getLeTupleTableByID($table, $id) {
        self::seConnecter();
        try {
            self::$request = "SELECT * FROM " . $table . " WHERE id=" . $id;
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->execute();
            self::$result = self::$pdoStResults->fetch();

            self::$pdoStResults->closeCursor();

            return self::$result;
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    public static function deleteTupleTableByID($table, $id) {
        self::seConnecter();
        try {
            self::$request = "DELETE FROM Produit WHERE id= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    public static function isAdminOK($login, $pass) {
        self::seConnecter();
        try 
        {
            self::$request = "SELECT * From utilisateur where pseudo=:login and passe=:pass";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('login', $login);
            self::$pdoStResults->bindValue('pass', sha1($pass));
            self::$pdoStResults->execute();
            self::$result = self::$pdoStResults->fetch();
            self::$pdoStResults->closeCursor();
            
            if ((self::$result != null) and self::$result->isAdmin) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getMessage();
        }
    }

    // </editor-fold>
}

//Test des services (méthodes) de la classe ShopManagement
//-------------------------------------------------------


