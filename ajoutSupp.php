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
            include "Collection.php";
            echo '<link rel="stylesheet" href="Acceuil.css" />';
            $bdd = "dnunez_pro";
            $host = "lakartxela.iutbayonne.univ-pau.fr";
            $user = "dnunez_pro";
            $pass = "dnunez_pro";

            $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);
            $result = $connPDO->query("SELECT * FROM VentesCD");
            $laCollection = new Collection();
            $laCollection->loadFromQuerryPDO($result);
            $result->closeCursor();

            $lesDisques = $laCollection->getDisques();
            $nbDisques = sizeof($lesDisques);
            echo '<ul>';
    
            for ($i=0; $i < $nbDisques; $i++) { 
            $unDisque =     $lesDisques[$i];
            $laCouverture = $unDisque->getCouvertureMin();
            $leNom =        $unDisque->getTitre();
            $lAuteur =     $unDisque->getAuteur();
            $sDisc = $unDisque->toString();
            print ("<li>
                <form action=\"DetailDisc.php\" method=\"POST\">
                    <button class=\"titre\" type=\"submit\" name=\"LeDisque\" class=\"styled\" value=\"$sDisc\">
                        <img src=$laCouverture height=\"150\" width=\"150\" onclick=\"help\">
                        <p class=\"Titre\">$leNom</p>
                        <p>$lAuteur</p>
                    </button>
                </form>
            </li>");
    }
            echo'</ul>';
}} ?>      