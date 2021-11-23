<?php 
/*ON DOIT MODIFIER CE FICHIER POUR L'IMPORT DES IMAGES */
    include "Disc.php";
    $bdd = "dnunez_pro";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "dnunez_pro";
    $pass = "dnunez_pro";

    try{
    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);
    }
    catch(PDOException $error)
    {
        echo 'Echec de la connexion';
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nomAlbum = $_POST["nomAlbum"]; 
        $nomArtiste = $_POST["nomArtiste"];
        $genre = $_POST["nomGenre"];
        $prix = $_POST["prix"];
        //$photo = $_POST["photo"]; 

        /*Expression régulière, indiquant qu'il faut rentrer uniquement une chaine de caractères avec 
        uniquement des lettres sans accent, et la première lettre doit être en majuscule. Exemple : Lumiere */

        $pattern = "/^[A-Z]([a-z]+)/";

        /*Arrondi le prix s'il l'utilisteur a ajouté plusieurs chiffres après la virgule
        Exemple : 15.48678 -> 15.49 */
        $prixA=round($prix,2);


        /* Ajoute le disque si toutes les conditions sont respectées, c'est à dire:
        Le nom de l'album, le nom de l'artiste ne soit pas vide
        Que l'administateur n'ait mit que des chiffres dans le prix
        Que le prix soit supérieur à 0
        
        Il manque:
        Que le format de photo est respecté
        */
        if (!empty($nomAlbum) & !empty($nomArtiste) & preg_match($pattern, $genre) & $prixA > 0)
        {
            $unDisque = new Disc($nomAlbum,$nomArtiste,$genre,$prixA,$photo);
            $unDisque->DiscToBDPDO($connPDO);
        }
        else
        {
            echo '<body onLoad="alert(\'Veuillez vérifier vos saisies\')">';
        }
        
      }
      echo '<meta http-equiv="refresh" content="0;URL=ajoutSupp.php">';
?>