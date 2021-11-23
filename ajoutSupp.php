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
            echo '<h2>Ajouter un cd </h2>';
            echo'
            <form action="Ajout.php" method="post" enctype="multipart/form-data" >
                Titre Album: <input type="text" name="nomAlbum"><br />
                Nom Artiste : <input type="text" name="nomArtiste" ><br />
                Genre: <input type="text" name="nomGenre"><br />
                Prix <input type="text" name="prix" ><br />
                La photo <input type=file name="photo" ><br>
            <input type="submit" name"cdAjout" value="Ajouter le cd"></form>';
        }

        elseif (isset($_POST['Supp'])) { 
            include "FunctionsSupp.php";
            echo '<h2>Supprimer un cd</h2>';

            afficherSupprimer($connPDO);}
}?>      
<!-- <button class=\"titre\" type=\"submit\" name=\"LeDisque\" class=\"styled\" value=\"$sDisc\">