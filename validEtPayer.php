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
        <form action="facture.php" method="POST" class="formDon">
            <div class="formAchat">
                <label for="Nom">Nom sur la carte: </label>
                <input type="text" name="Nom" id="Nom" required>
            </div>
            <div class="formAchat">
                <label for="Prenom">Prénom sur la carte: </label>
                <input type="text" name="Prenom" id="Prenom" required>
            </div>
            <div class="formAchat">
                <label for="Mail">Mail de facturation: </label>
                <input type="email" name="Mail" id="Mail" required>
            </div>
            <div class="formAchat">
                <label for="numCarte">Numéro de la carte: </label>
                <input type="number" name="numCarte" id="numCarte" max="9999999999999999"required>
            </div>
            <div class="formAchat">
                <label for="dateExpi">Date d'expiration de la carte: </label>
                <?php
                    $dateMin = date("Y-m");
                    print ("<input type=\"month\" name=\"dateExpi\" id=\"dateExpi\" min=\"$dateMin\" required>");
                ?>
            </div>
            <div class="formAchat">
                <label for="CCV">CCV de la carte: </label>
                <input type="number" name="CCV" id="CCV" max="999" required>
            </div>
            <div class="formAchat">
                <input type="Submit" value="Valider">
            </div>
        </form>
    </body>
</html>

