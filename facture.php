<?php
    include "Panier.php";
    include "FunctionsSupp.php";
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
                    <h1>Votre facture</h1>';
                    $panier = unserialize($_SESSION['Panier']);
            
        echo'</header>';
        
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $mail = $_POST['Mail'];
            $numCarte = $_POST['numCarte'];
            $CCV = $_POST['CCV'];
            $dateExpi = $_POST['dateExpi'];
            $dateValable = date("Y-m",strtotime('+3 month'));
            $dateMaintenant = date('d/m/Y');

            // Expression régulière, qui "oblige" l'utilisateur à saisir 16 chiffres pour le code de la CB
            $pattern = "/^[0-9]{16}/";

            // Expression régulière, qui "oblige" l'utilisateur à saisir 3 chiffres pour le code du CCV
            $pattern2 = "/^[0-9]{3}/";

            /* On vérifie si tout est correct c'est à dire :
                Le nom, prénom, mail ne soit pas vide
                Si il y a bien 16 chiffres dans le code de la CB-> preg_match($pattern,$numCarte)
                Si il y a bien 3 chiffes dans le code du CCV -> preg_match($pattern2,$CCV)
                Si le premier chiffre du code de la CB = le dernier chiffre du code de la CB
                Si la date d'expiration de la carte est valable ou non (supérieur à 3 mois à partir d'aujourd'hui)
            */
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL) & !empty($nom) & !empty($prenom) & !empty($mail) & preg_match($pattern,$numCarte) & preg_match($pattern2,$CCV) & $numCarte[0]==$numCarte[15] & $dateExpi >= $dateValable)
            {
                $panier = unserialize($_SESSION['Panier']);
                $aPayer = $panier->prixTotal();
                //mail($mail, "Facture du $dateMaintenant", "Bonjour $prenom $nom,\n \t ceci est le confirmation de votre commande de CDs de $aPayer €");
                print("<p> Payement effectué le $dateMaintenant <br>
                        Mail de confirmation envoyé à $mail </p>");
                $panier->vider();
                echo '
                <form action="Acceuil.php">
                    <button class="menu"> Acceuil </button>
                </form>';
                $_SESSION['Panier'] = serialize($panier);
            }
            //Si la date d'expiration n'est pas valable
            elseif(!($dateExpi >= $dateValable))
            {
                echo '<body onLoad="alert(\'La date d\\\'expiration n\\\'est pas valide\')">';
                echo '</body>';
                echo '<meta http-equiv="refresh" content="0;URL=validEtPayer.php">';
                
            }
            //Pour toutes autres erreurs
            else
            {
                echo '<body onLoad="alert(\'Veuillez remplir tout les champs correctement\')">';
                
                echo '<meta http-equiv="refresh" content="0;URL=validEtPayer.php">';
            }
            
        
            echo'</body>
            </html>';
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0;URL=Formulaire.html">';
    }
