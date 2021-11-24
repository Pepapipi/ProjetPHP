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
            <h1>Votre panier</h1>
            <?php
            $panier = unserialize($_SESSION['Panier']);
            if (isset($_SESSION['loginU']) && isset($_SESSION['pwdU'])) {
                echo '<p>Vous êtes connecté</p>
                    <form>
                    <input type="submit" formaction="logout.php" value="Deconnexion" name="Deco">
                    </form>';
            }
            else
            {
                print(" <form action=\"Formulaire.html\">
                        <button class=\"menu\"> Se connecter </button>
                        </form>");
            }
            ?>
            </form>
            <form action="Acceuil.php">
                <button class="menu"> Acceuil </button>
            </form>
        </header>
        <?php
        ?>
        <form method="POST">
        <il>
            
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
                                    <img src=\"$laCouverture\" height=\"150\" width=\"150\" onclick=\"help\">
                                    <p class=\"Titre\">$leNom</p>
                                    <p>$lAuteur</p>
                                </button>
                            </form>");
                }
                echo'</ul>';
                $prixTotal = $panier->prixTotal();
                print(" <p> Le prix total du panier <strong>$prixTotal €</strong></p>
                        <p> Cliquez sur un disque pour le suprimer du panier</p>
                        <input type=\"submit\" name=\"suprTout\" value=\"Vider le panier\" class=\"button\">
                        <input type=\"submit\" value=\"Valider et payer\" class=\"button\" formaction=\"validEtPayer.php\">
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
