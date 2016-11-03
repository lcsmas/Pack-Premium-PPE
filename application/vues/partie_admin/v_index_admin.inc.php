<section style='padding-bottom: 25px;'>
    <div class="titre">
        Administration du site (Accès réservé) <br />
        - Bonjour <?php echo $_SESSION['login_admin']; ?> -
    </div>
    
    <div class="cat1">
        <a href="index.php?cas=gererNews"><img src='<?php echo chemins::IMAGES . "martournal.png"; ?>' height="75" width="75">Gestion des news </a><br />       
    </div>
    <div class='cat2'>       
        <a href="index.php?cas=seDeconnecter"><img src='<?php echo chemins::IMAGES . "logout.png"; ?>'  height="75" width="75" > Se déconnecter (<?php echo $_SESSION['login_admin']; ?>)</a>
    </div>
</section>