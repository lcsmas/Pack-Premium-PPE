<div class="container" style="padding-top: 20px;">
    
    <div class="row">
        <div class="col-lg-12">
            <form  action='index.php?cas=supprimerNews' method='post' >
                <input type="submit" value="Supprimer la sélection" class="form-control" >
                <table class="table table-bordered table-hover" > <!-- border="1" style='width: 100%;' !--> 
                    <caption
                        <h4>Récapitulatif des news</h4>
                    </caption>           
                    <tr>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach (VariablesGlobales::$lesNews as $uneNews) {
                        $i = $i + 1;
                        ?>     
                        <tr>                         
                            <td> <input class="checkbox-inline" type="checkbox" name="deletebox<?php echo $i ?>" ><br> <?php echo $uneNews->titre ?></td> 
                            <td> <?php echo $uneNews->contenu ?></td>
                            <td> <?php echo $uneNews->date ?></td>
                        </tr>              

                        <?php
                    }
                    ?>
                </table>

            </form> 
        </div>
    </div>
</div>





