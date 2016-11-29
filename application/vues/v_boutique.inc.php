<script>
    $(function(){
        
    });
</script>

<section>
    <div class="container" style="padding-top: 1%; padding-bottom: 1%">
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">                  
                    <li class="active"><a  href="index.php?controleur=boutique&action=afficher&categorie=<?php echo VariablesGlobales::$lesCategories[0]->idCategorie?>"><?php echo VariablesGlobales::$lesCategories[0]->LibelleCategorie?></a></li>
                    <?php for ($index = 1; $index < count(VariablesGlobales::$lesCategories); $index++) { ?>
                    <li><a href="index.php?controleur=boutique&action=afficher&categorie=<?php echo VariablesGlobales::$lesCategories[$index]->idCategorie?>">
                        <?php echo VariablesGlobales::$lesCategories[$index]->LibelleCategorie ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php if(isset(VariablesGlobales::$lesProduits)) { ?>
            <div class="col-md-10">
                <ul>
                <?php for ($index = 0; $index < count(VariablesGlobales::$lesProduits); $index++) { $monProduit = VariablesGlobales::$lesProduits[$index]?>
                    <li>
                        <?php echo $monProduit->LibelleProduit?> <br /> 
                        <img src="<?php echo chemins::IMAGES_PRODUITS . $monProduit->ImageProduit?>" alt="image_produit" height="200" width="200"><br /> 
                        <?php echo 'Prix : ' . $monProduit->PrixHTProduit . '€<br />' .
                            'Quantité en stock : '.$monProduit->QteStockProduit. ' unité(s)' ?>
                        <a href='index.php?controleur=panier&action=ajouter&idProduit=<?php echo $monProduit->idProduit?>'> <img  src="<?php echo chemins::IMAGES . 'ajouter_panier.png'?>"></a>
                    </li>
                <?php } ?>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</section>

