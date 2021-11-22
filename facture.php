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
                <button class="menu"> Acceuil </button>
            </form>
        </header>
        <?php
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $mail = $_POST['Mail'];
            $numCarte = $_POST['numCarte'];
            $CCV = $_POST['CCV'];
            $dateExpi = $_POST['dateExpi'];
            $date = date("j/m/Y");
            $panier = unserialize($_SESSION['Panier']);
            
            $aPayer = $panier->prixTotal();
            
            mail($mail, "Facture du $date", "Bonjour $prenom $nom,\n \t ceci est le confirmation de votre commande de CDs de $aPayer €");
            print("<p> Mail envoyé à $mail </p>");

            $panier->vider();
        ?>
    </body>
</html>