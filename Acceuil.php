<?php
    include "Collection.php";

    print("<!DOCTYPE html>
    <html>
        <head>
            <meta charset=\"UTF-8\">
            <title>Acceuil</title>
            <link rel=\"stylesheet\" href=\"Acceuil.css\" />
        </head>
        <body>
            <header>
                <h1>Achat de titre</h1>
            </header>");

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
    ?>
    <ul>
    <?php
    for ($i=0; $i < $nbDisques; $i++) { 
        $unDisque =     $lesDisques[$i];
        $laCouverture = $unDisque->getCouverture();
        $leNom =        $unDisque->getTitre();
        $lAuteur =     $unDisque->getAuteur();
        print ("<li>
        <form action=\"DetailDisc.php\" method=\"POST\">
            <button type=\"submit\" name=\"\$unDisque\" class=\"styled\">
                <img src=$laCouverture height=\"150\" width=\"150\" onclick=\"help\">
                <p class=\"Titre\">$leNom</p>
                <p>$lAuteur</p>
            </button>
        </form>
    </li>
    ");
    }
    ?>
    </ul>  
<?php
    print("
    </body>
</html>");
?>