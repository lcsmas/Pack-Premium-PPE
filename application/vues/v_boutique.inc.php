<script>
    $(function(){
        
    });
</script>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">                  
                    <li class="active"><a  href="#"><?php echo VariablesGlobales::$lesCategories[0]->LibelleCategorie?></a></li>
                    <?php for ($index = 1; $index < count(VariablesGlobales::$lesCategories)-1; $index++) { ?>
                    <li><a href="#"><?php echo VariablesGlobales::$lesCategories[$index]->LibelleCategorie ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-10">
                
            </div>
        </div>
    </div>
</section>

