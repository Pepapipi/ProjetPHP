<?php


    include "Collection.php";
    $bdd = "dnunez_pro";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "dnunez_pro";
    $pass = "dnunez_pro";

    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);

    function afficherSupprimer(PDO $connPDO) {
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
            $sdisc=        $unDisque->toString();
            print ("<li>
            <form method=\"POST\" action=\"Suppresion.php\">
                <button class=\"titre\" type=\"submit\" name=\"LeDisque\" class=\"styled\" value=\"$sdisc\">
                    <img src=\"$laCouverture\" height=\"150\" width=\"150\" onclick=\"help\">
                    <p class=\"Titre\">$leNom</p>
                    <p>$lAuteur</p>
                </button>
            </form >
        </li>
        ");
        }
        echo'</ul>';
    }

    function supprimer(PDO $connPDO, Disc $discASup){
        
        $titre = $discASup->getTitre();
        $auteur = $discASup->getAuteur();

        $connPDO->beginTransaction();
        if ($connPDO->exec("DELETE FROM VentesCD WHERE `VentesCD`.`TITRE`=\"$titre\" AND `VentesCD`.`AUTEUR` = \"$auteur\" ")){
            unlink($discASup->getCouvertureMin());
            unlink($discASup->getCouvertureMax());
            $connPDO->commit();
        }

    }
?>