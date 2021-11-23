<?php
    include "Panier.php";
    include "FunctionsSupp.php";
    session_start();

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
    $disque = $_POST['LeDisque'];
    $disqueP =explode(",", $disque);
    $disc = new Disc($disqueP[0],$disqueP[1],$disqueP[2],$disqueP[3],$disqueP[4]) ;
    supprimer($connPDO, $disc);
    echo '  <body onLoad="alert(\'Suppression du disque effectuée\')">
            <meta http-equiv="refresh" content="0;URL=ajoutSupp.php">';
?>