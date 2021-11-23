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
        <b class="entete">
            <b class="gauche">
            <form action="Acceuil.php">
                <button class="menu"> Acceuil </button>
            </form>
            </b>
            <b class="millieu">
            <h1>Votre panier</h1>
            </b>
            <b class="droite">
            <?php
            $panier = unserialize($_SESSION['Panier']);
            if (isset($_SESSION['loginU']) && isset($_SESSION['pwdU'])) {
                echo '<p>Vous êtes connecté</p>
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
            </form>
        </b>
        </header>
        <?php
        ?>
        <form method="POST">
        <il>
        <h3 class="centré"> Cliquez sur un disque pour le suprimer du panier</h3>
        <?php
            $panier = unserialize($_SESSION['Panier']);
            $nbItem = $panier->getNbItems();
            //Si l'utilisateur décide de retirer un article en cliquant dessus
            if (isset($_POST['LeDisque'])){
                $iDisqueASup=$_POST['LeDisque'];
                $panier->delItem($iDisqueASup);
                $_POST['LeDisque'] = false;
            }
            //Si l'utilisateur décide de vider le panier
            elseif(isset($_POST['suprTout'])){
                $panier->vider();
            }

            $_SESSION['Panier'] = serialize($panier);
            //Afficher les articles dans le panier
            if (! ($panier->isEmpty())){
                echo'<ul>';
                for ($i=0; $i < $panier->getNbItems(); $i++) { 
                    $leDisc = $panier->getItem($i);
                    $laCouverture = $leDisc->getCouvertureMin();
                    $leNom =        $leDisc->getTitre();
                    $lAuteur =     $leDisc->getAuteur();
                    print ("<form method=\"POST\">
                                <button class=\"titre\" type=\"submit\" name=\"LeDisque\" class=\"styled\" value=\"$i\">
                                    <img src=$laCouverture height=\"150\" width=\"150\" onclick=\"help\">
                                    <p class=\"Titre\">$leNom</p>
                                    <p>$lAuteur</p>
                                </button>
                            </form>");
                }
                echo'</ul>';
                $prixTotal = $panier->prixTotal();
                print(" <p class=\"prixTotal\"> Le prix total du panier <strong>$prixTotal €</strong></p>
                        <input class=\"bouton2\" type=\"submit\" name=\"suprTout\" value=\"Vider le panier\" class=\"button\">
                        <input class=\"bouton2\" type=\"submit\" value=\"Valider et payer\" class=\"button\" formaction=\"validEtPayer.php\">
                        ");

            }
            else{
                print ("<p>Le Panier est vide<p>");
            }

        ?>
        
        </il>
        </form>
    </body>
</html>