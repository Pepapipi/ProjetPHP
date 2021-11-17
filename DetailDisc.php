<?php
    print("<!DOCTYPE html>
    <html>
        <head>
            <meta charset=\"UTF-8\">
            <title>Acceuil</title>
            <link rel=\"stylesheet\" href=\"Acceuil.css\" />
        </head>
        <body>
            <header>
                <h1>Détail de titre</h1>
            </header>");
    include "Disc.php";

    $bdd = "dnunez_pro";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "dnunez_pro";
    $pass = "dnunez_pro";

    $LeDisque=$_POST['LeDisque'];

    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);
    $result = $connPDO->query("SELECT * FROM VentesCD");
    while ($tuple = $result->fetch()) {
        if ($tuple[0]==$LeDisque){
            $LeDisque = new Disc($tuple[0], $tuple[1], $tuple[2], $tuple[3], $tuple[4]);
        }
    }
    $result->closeCursor();
    
    $laCouverture = $LeDisque->getCouvertureMax();
    $leTitre = $LeDisque->getTitre();
    $lAuteur = $LeDisque->getAuteur();
    $leGenre = $LeDisque->getGenre();
    $lePrix = $LeDisque->getPrix();
    print("         <img src=$laCouverture>
            <p>$leTitre</p>
            <p>$lAuteur</p>
            <p>$leGenre</p>
            <p>$lePrix €</p>");
    
?>