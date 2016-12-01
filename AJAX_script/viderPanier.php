<?php

require_once '../libs/Panier.class.php';
require_once '../configs/chemins.class.php';
session_start();

    foreach (Panier::getProduits() as $unProduit) {
        $id = $unProduit->idProduit;
        $nom = $unProduit->LibelleProduit;
        $prix = $unProduit->PrixHTProduit;
        $categorie = $unProduit->idCategorie;
        $cheminImage = Chemins::IMAGES_PRODUITS . $unProduit->ImageProduit;
        ?>
        <article>
            <img src="<?php echo $cheminImage ?>" alt=image height="200" width="200" />
            <p>
                <?php
                echo $nom . " ($prix Euros)";
                ?>
            </p>
            <a href="index.php?cas=retirerDuPanier&produit=<?php echo $id ?>" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                <img src="<?php echo Chemins::IMAGES . 'retirer_panier.png' ?>" TITLE="Retirer du panier" ></a>


        </article>	
        <?php
    }



