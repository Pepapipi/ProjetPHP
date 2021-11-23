<?php
    include "Panier.php";
    include "Disc.php";
    session_start();

    if (isset($_SESSION['loginU']) && isset($_SESSION['pwdU'])) {
        echo'<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Acceuil</title>
                        <link rel="stylesheet" href="Acceuil.css" />
                    </head>
                    <body>
                        <header>
                            <h1>Votre panier</h1>';
                            $panier = unserialize($_SESSION['Panier']);
                            print "<p>Vous êtes connecté</p>";
                            echo '<form action="gestionPanier.php">
                                    <button class="menu"> Voir panier</button>
                                </form>
                                <form action="Acceuil.php">
                                    <button class="menu"> Acceuil </button>
                                </form>
                                <form>
                                    <input type="submit" formaction="logout.php" value="Deconnexion" name="Deco">
                                </form>
                        </header>
                        <form action="facture.php" method="POST" class="formDon">
                            <div class="formAchat">
                                <label for="Nom">Nom sur la carte: </label>
                                <input type="text" name="Nom" id="Nom">
                            </div>
                            <div class="formAchat">
                                <label for="Prenom">Prénom sur la carte: </label>
                                <input type="text" name="Prenom" id="Prenom">
                            </div>
                            <div class="formAchat">
                                <label for="Mail">Mail de facturation: </label>
                                <input type="email" name="Mail" id="Mail">
                            </div>
                            <div class="formAchat">
                                <label for="numCarte">Numéro de la carte: </label>
                                <input type="number" name="numCarte" id="numCarte" max="9999999999999999">
                            </div>
                            <div class="formAchat">
                                <label for="dateExpi">Date d\'expiration de la carte: </label>
                                <input type="month" name="dateExpi" id="dateExpi" min="$dateMin">
                            </div>
                            <div class="formAchat">
                                <label for="CCV">CCV de la carte: </label>
                                <input type="number" name="CCV" id="CCV" max="999">
                            </div>
                            <div class="formAchat">
                            <input type="Submit" value="Valider">
                            </div>
                        </form>
                    </body>
            </html>';
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0;URL=Formulaire.html">';
    }