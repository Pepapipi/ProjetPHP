<?php
 // On définit un login et un mot de passe de base
 $loginU_valide = "roose";
 $pwdU_valide = "roose";

 $loginA_valide = "root";
 $pwdA_valide = "root";

    // on teste si nos variables sont définies
    if ((isset($_POST['loginU']) && isset($_POST['pwdU'])) || (isset($_POST['loginA']) && isset($_POST['pwdA']))) {
        // on vérifie les informations saisies
        if ($loginU_valide == $_POST['loginU'] && $pwdU_valide == $_POST['pwdU']) {
            session_start ();

            // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (
            $_SESSION['loginU'] = $_POST['loginU'];
            $_SESSION['pwdU'] = $_POST['pwdU'];

            // on redirige notre visiteur vers une page de notre section membre
            header ('location: Acceuil.php');
        }

        if($loginA_valide == $_POST['loginA'] && $pwdA_valide == $_POST['pwdA']){
            session_start ();

            // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (
            $_SESSION['loginA'] = $_POST['loginA'];
            $_SESSION['pwdA'] = $_POST['pwdA'];
            // on redirige notre visiteur vers une page de notre section membre
            header ('location: ajoutSupp.php');
        }

        else {
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=Formulaire.html">';
        }
    } 
    else {
        echo 'Les variables du formulaire ne sont pas déclarées.';
    }
 ?>
