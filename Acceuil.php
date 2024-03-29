<?php
    include "Collection.php";
    include "Panier.php";
    session_start();
    if(!(isset($_SESSION['Panier']))) // On verifie si le panier existe dans la session et en creé un sinon
    {
        $panier = new Panier();
        $_SESSION['Panier'] = serialize($panier);
    }
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Acceuil</title>
            <link rel="stylesheet" href="Acceuil.css" />
        </head>
        <body>
            <header>
                <b class="entete">
                    <b class="gauche">
                        <form action="gestionPanier.php">
                            <button class="menu"> Voir panier</button>
                        </form>
                    </b>
                    <b class="millieu">
                        <h1>Achat de titre</h1>
                    </b>
                    <b class="droite">
                        <?php
                        if (isset($_SESSION['loginU']) && isset($_SESSION['pwdU'])) {
                            echo'<p>Vous êtes connecté</p>
                            <form>
                            <input class="menu" type="submit" formaction="logout.php" value="Deconnexion" name="Deco">
                            </form>';
                        }
                        else
                        {
                            print(" <form action=\"Formulaire.php\">
                                    <button class=\"menu\"> Se connecter </button>
                                    </form>");
                        }
                        ?>
                    </b>
                </b>
            </header>

    <?php
    $bdd = "dnunez_pro";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "dnunez_pro";
    $pass = "dnunez_pro";

    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass); // Connexion à la BD où sont les disques
    $result = $connPDO->query("SELECT * FROM VentesCD"); // Recupère la liste des disques
    $laCollection = new Collection(); // Créé une collection où serons stockés les disques
    $laCollection->loadFromQuerryPDO($result); // Met les disque dans la collection
    $result->closeCursor(); // Ferme la connexion à la BD

    $lesDisques = $laCollection->getDisques(); 
    $nbDisques = sizeof($lesDisques);
    ?>
    <ul>
    <?php
    for ($i=0; $i < $nbDisques; $i++) // On affiche tout les disques sous forme de boutons
    { 
        $unDisque =     $lesDisques[$i];
        $laCouverture = $unDisque->getCouvertureMin();
        $leNom =        $unDisque->getTitre();
        $lAuteur =     $unDisque->getAuteur();
        $sDisc = $unDisque->toString();
        print ("<li>
        <form action=\"DetailDisc.php\" method=\"POST\">
            <button class=\"titre\" type=\"submit\" name=\"LeDisque\" class=\"styled\" value=\"$sDisc\">
                <img src=\"$laCouverture\" height=\"150\" width=\"150\" onclick=\"help\">
                <p class=\"Titre\">$leNom</p>
                <p>$lAuteur</p>
            </button>
        </form>
    </li>
    ");
    }
    ?>
    </ul>

    </body>
</html>