<?php

session_start();
require_once 'configs/chemins.class.php';
require_once chemins::CONFIGS . 'variables_globales.class.php';
require_once chemins::CONFIGS . 'mysql_config.class.php';
require_once chemins::MODELES . 'gestion_bdd.class.php';
require_once chemins::MODELES . 'gestion_news.class.php';
require_once chemins::MODELES . 'gestion_categorie.class.php';
require_once chemins::VUES_PERMANENTES . 'v_entete.inc.php';

$controleur =           !isset($_REQUEST['controleur']) ? 'accueil' : $_REQUEST['controleur'];
$fichier_controleur =   'controleur_'.$controleur.'.class.php';
$classe_controleur =    'Controleur'.$controleur;
$action =               !isset($_REQUEST['action']) ? 'afficherLesNews' : $_REQUEST['action'];

require_once chemins::CONTROLEURS . $fichier_controleur;

$classe_controleur = new $classe_controleur();
$classe_controleur->$action();

//if ($cas == 'accueil') { 
//    
//    $controleurAccueil = new ControleurNews();
//    $controleurAccueil->afficherLesNews();    
//    
//} elseif (file_exists(chemins::VUES . 'v_' . $cas . '.inc.php')) {
//    require chemins::VUES . 'v_' . $cas . '.inc.php';
//    
//} elseif ($cas == 'afficherIndexAdmin') {
//    if (isset($_SESSION['login_admin']))
//        require chemins::VUES_ADMIN . "v_index_admin.inc.php";
//    else
//        require chemins::VUES_ADMIN . "v_connexion.inc.php";
//    
//} elseif ($cas=='supprimerNews'){   
//    if (isset($_SESSION['login_admin'])){
//        $controleurSupprimerNews = new ControleurNews();
//        $controleurSupprimerNews->supprNews();
//        $controleurSupprimerNews->afficherLesNews();
//    }
//    else
//        require chemins::VUES_ADMIN . 'v_acces_interdit.inc.php';
//       
//} elseif ($cas == 'ajouterNews') {
//    if (isset($_SESSION['login_admin'])) {
//        $controleurAjouterNews = new ControleurNews();
//        if ($_POST['contenu'] != "" && $_POST['titre'] != "") {
//            $controleurAjouterNews->ajouterNews();
//            $controleurAjouterNews->afficherLesNews();
//        } else {        
//            echo '<p> Veuillez remplir tout les champs</p>';
//            require chemins::VUES_ADMIN . "v_creationNews.inc.php";
//        }
//    }
//    else {
//        require chemins::VUES_ADMIN . "v_acces_interdit.inc.php";
//    }
//    
//} elseif ($cas == 'creationNews') {
//        if(isset($_SESSION['login_admin']))
//            require chemins::VUES_ADMIN . 'v_creationNews.inc.php';
//        else {
//        require chemins::VUES_ADMIN . "v_acces_interdit.inc.php";
//    }
//        
//} elseif ($cas == 'gererNews') {
//    if (isset($_SESSION['login_admin'])) {
//        require chemins::VUES_ADMIN . "v_index_admin.inc.php";
//        $controleurRecapNews = new ControleurNews();
//        $controleurRecapNews->afficherRecapNews();
//    } else {
//        require chemins::VUES_ADMIN . "v_acces_interdit.inc.php";
//    }
//    
//} elseif ($cas == 'verifierConnexion') {
//    if (GestionNews::isAdminOK($_POST['login'], $_POST['passe'])) {
//        $_SESSION['login_admin'] = $_POST['login'];
//        if (isset($_POST['connexion_auto']))
//            setcookie('login_admin', $_POST['login'], time() + 7 * 24 * 3600, null, null, false, true);
//
//        $controleurConnexion = new ControleurNews();
//        $controleurConnexion->afficherLesNews();
//    } else
//        require chemins::VUES_ADMIN . "v_acces_interdit.inc.php";
//}
//
//elseif ($cas == 'seDeconnecter') {
//    $_SESSION = array();
//    session_destroy();
//    setcookie('login_admin', '');
//    header("Location:index.php");
//} else
//    require chemins::VUES . 'v_erreur404.inc.php';

require_once chemins::VUES_PERMANENTES . 'v_pied.inc.php';

