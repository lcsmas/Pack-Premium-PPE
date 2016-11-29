<section class="panier">
    <img src="<?php echo Chemins::IMAGES . 'mon_panier.png' ?>"	alt="Panier" title="panier"/>
    <a class="viderPanier" href="index.php?cas=viderPanier">Vider le panier</a>
    <?php
    var_dump(VariablesGlobales::$lesProduits);
    foreach (VariablesGlobales::$lesProduits as $unProduit) {
        $id = $unProduit->idProduit;
        $nom = $unProduit->LibelleProduit;
        $prix = $unProduit->PrixHTProduit;
        $categorie = $unProduit->idCategorie;
        $cheminImage = Chemins::IMAGES_PRODUITS . $unProduit->ImageProduit;
        ?>
        <article>
            <img src="<?php echo $cheminImage ?>" alt=image />
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
    ?>
    <a class="commander" href="#"><img src="<?php echo Chemins::IMAGES . 'je_commande.jpg' ?>" TITLE="Passer commande" ></a>
</section>

