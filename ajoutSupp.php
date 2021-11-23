<!DOCTYPE html>
<form action="ajoutSupp.php" method="post"> 
<input type="submit" value="Ajouter un CD" name="Ajout">
<input type="submit" value="Supprimer un CD" name="Supp"><br>
<input type="submit" formaction="logout.php" value="Deconnexion" name="Deco">
</form>
<link rel="stylesheet" href="Acceuil.css" />
   
<?php
    
    
    if (!empty($_POST)) { 
        if (isset($_POST['Ajout'])) { 
            echo'
            <div class="AjoutTitre">
            <h2>Ajouter un cd </h2>
            <form action="Ajout.php" method="post" enctype="multipart/form-data">
                <p> Titre Album: <input type="text" name="nomAlbum"><br /> </p>
                <p> Nom Artiste : <input type="text" name="nomArtiste" ><br /></p>
                <p> Genre: <input type="text" name="nomGenre"><br /></p>
                <p> Prix: <input type="number" name="prix" min="0"><br /></p>
                <p> La photo (.jpg)<input type=file accept="image/jpeg" name="photo"><br/></p>
            <input type="submit" name"cdAjout" value="Ajouter le cd"><br><br></form>
            </div>';
        }

        elseif (isset($_POST['Supp'])) { 
            include "FunctionsSupp.php";
            echo '<h2>Supprimer un cd</h2>';

            afficherSupprimer($connPDO);}
}?>      
<!-- <button class=\"titre\" type=\"submit\" name=\"LeDisque\" class=\"styled\" value=\"$sDisc\">