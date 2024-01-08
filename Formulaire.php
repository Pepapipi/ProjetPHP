<html> 
    <meta charset="UTF-8">
    <title>Formulaire d'identification</title>
    <link rel="stylesheet" type="text/css" href="Acceuil.css" />
 <body>
    <header>
    <b class="entete">
        <b class="gauche">
            <form action="Acceuil.php">
                <button class="menu"> Retour acceuil </button>
            </form>
        </b>
        <b class="millieu">
            <h1>Formulaire d'identification</h1>
        </b>
    </b>
    </header>
    <div id="Formulaires">
        <div id="Formulaire_Connexion_U">
        
            <form action="login.php" method="post">
                <div class="aa"></div>
                <p>Connexion Utilisateur</p>
                Login : <input type="text" name="loginU" id="loginU">
                <br />
                Mot de passe : <input type="password" name="pwdU"><br />
                <input type="submit" value="Connexion">
            </form>
        </div>
        <div id="Formulaire_Connexion_A">
        <form action="login.php" method="post">
                <p>Connexion Administrateur</p>
                Login : <input type="text" name="loginA">
                <br />
                Mot de passe : <input type="password" name="pwdA"><br />
                <input type="submit" value="Connexion">
            </form>
        </div>
    </div>
    </body>
</html>


<!-- On doit travailler le css sur cette page-->