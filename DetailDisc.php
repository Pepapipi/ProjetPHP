<?php
    include "Panier.php";
    include "Disc.php";
    session_start();
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
                <h1>Détail de titre</h1>
                <?php
                if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
                    print "<p>Vous êtes connecté</p>";
                }
                else
                {
                    print(" <form action=\"Login.php\">
                            <button class=\"menu\"> Se connecter </button>
                            </form>");
                }
                ?>
                </form>
                <form action="gestionPanier.php">
                    <button class="menu"> Voir panier</button>
                </form>
                <form action="Acceuil.php">
                    <button class="menu"> Retour </button>
                </form>
            </header>
            <?php

                $bdd = "dnunez_pro";
                $host = "lakartxela.iutbayonne.univ-pau.fr";
                $user = "dnunez_pro";
                $pass = "dnunez_pro";

                if (isset($_POST['LeDisque'])){
                    $LeDisque=$_POST['LeDisque'];
                    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);
                    $result = $connPDO->query("SELECT * FROM VentesCD");
                    while ($tuple = $result->fetch()) {
                        if ($tuple[0]==$LeDisque){
                            $LeDisque = new Disc($tuple[0], $tuple[1], $tuple[2], $tuple[3], $tuple[4]);
                        }
                    }
                    $result->closeCursor();
                    $_SESSION['LeDisque']=serialize($LeDisque);
                }else{
                    $LeDisque=unserialize($_SESSION['LeDisque']);
                }
    
                if (isset($_POST['panier'])){
                    $Panier = unserialize($_SESSION['Panier']);
                    $Panier->addItem($LeDisque);
                    $_SESSION['Panier'] = serialize($Panier);
                }
    
    
    
                $laCouverture = $LeDisque->getCouvertureMax();
                $leTitre = $LeDisque->getTitre();
                $lAuteur = $LeDisque->getAuteur();
                $leGenre = $LeDisque->getGenre();
                $lePrix = $LeDisque->getPrix();
                print(" <img src=$laCouverture>
                        <p>$leTitre</p>
                        <p>$lAuteur</p>
                        <p>$leGenre</p>
                        <p>$lePrix €</p>
                        <form method=\"post\">
                            <input type=\"submit\" name=\"panier\" class=\"button\" value=\"Ajouter au panier\" />
                        </form>");
                ?>