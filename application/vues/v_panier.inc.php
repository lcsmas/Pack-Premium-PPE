<?php require_once chemins::LIBS . 'Panier.class.php'; ?>

<script>
    $(function(){ 
        $(".viderPanier").click(function(){
             $.ajax({
                 url : 'index.php?controleur=panier&action=vider',
                 success : function(data){
                     $("html").html(data);
                     console.log(data);
                 }
             });
        });
    });
</script>

<section class="panier">
    
    <img src="<?php echo Chemins::IMAGES . 'mon_panier.png' ?>"	alt="Panier" title="panier"/>
    <button class="viderPanier" onclick="">Vider le panier</button> <!--href="index.php?controleur=panier&action=vider!--> 
    <?php
    foreach (VariablesGlobales::$lesProduits as $unProduit) {
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
    ?>
    <a class="commander" href="#"><img src="<?php echo Chemins::IMAGES . 'je_commande.jpg' ?>" TITLE="Passer commande" ></a>
</section>

