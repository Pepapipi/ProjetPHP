<?php 
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
        $photo = $_POST["photo"]; 
        
        $unDisque = new Disc($nomAlbum,$nomArtiste,$genre,$prix,$photo);
        $unDisque->DiscToBDPDO($connPDO);
        echo 'Le CD a bien été ajouté';
      }

?>