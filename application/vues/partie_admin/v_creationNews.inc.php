<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form class="well"  action='index.php?cas=ajouterNews' method='post' >     
                <span class="form-group">
                    <label for="titre"> Titre : </label>
                    <input type="text" name='titre' class="form-control"> 
                </span>
                <span class="form-group">
                    <label for="contenu">Contenu :</label>
                    <textarea name='contenu' placeholder="Entrer le contenu de la news" class="form-control" ></textarea>   
                </span>
                <span class="form-group">
                    <input style="width: 100%;" class="btn btn-primary" type='submit' value='Ajouter la News' class="form-control">
                </span>
            </form>
        </div>
    </div>
</div>
