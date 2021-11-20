<!DOCTYPE html>

<form action="ajoutSupp.php" method="post"> 
<input type="submit" value="Ajouter un CD" name="Ajout">
<input type="submit" value="Supprimer un CD" name="Supp"><br>
</form>

   
<?php
    
    
    if (!empty($_POST)) { 
        if (isset($_POST['Ajout'])) { 
            echo 'Tu as cliqué sur ajouté';
            echo'
            <form action="Ajout.php" method="post">
                Titre Album: <input type="text" name="nomAlbum" required><br />
                Nom Artiste : <input type="text" name="nomArtiste" required ><br />
                Genre: <input type="text" name="nomGenre" required><br />
                Prix <input type="number" name="prix" required ><br />
                La photo<input type=file name="photo" required><br>
            <input type="submit" name"cdAjout" value="Ajouter le cd"></form>';
        }

        elseif (isset($_POST['Supp'])) { 
            echo 'Tu as cliqué sur supprimer';
        }
    }
    
?>