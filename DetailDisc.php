<?php
    include "Panier.php";
    include "Disc.php";
    session_start();
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Détail De Titre</title>
            <link rel="stylesheet" href="Acceuil.css" />
        </head>
        <body>
            <header>
            <b class="entete">
                <b class="gauche">
                </form>
                <form action="gestionPanier.php">
                    <button class="menu"> Voir panier</button>
                </form>
                <form action="Acceuil.php">
                    <button class="menu"> Retour </button>
                </form>
</b>
                <b class="millieu">
                <h1>Détail de titre</h1>
</b>
                <b class="droite">
                <?php
                if (isset($_SESSION['loginU']) && isset($_SESSION['pwdU']))
                {
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
            </b>
            </header>
            <div id="PresentationDisc">
            <?php
                if (isset($_POST['LeDisque'])) // on enregistre le disque dans une variable de session pour le conserver si on ne passe pas par l'accueil
                {
                    $LeDisque=$_POST['LeDisque'];
                    
                    $array = explode(",",$LeDisque);

                    $LeDisque = new Disc($array[0], $array[1], $array[2], $array[3], $array[4]);
                    
                    $_SESSION['LeDisque']=serialize($LeDisque);
                }else{
                    $LeDisque=unserialize($_SESSION['LeDisque']);
                }
    
                if (isset($_POST['panier'])) // si le bouton ajout au panier a été cliqué, ajoute le disque en cours au panier
                {
                    $Panier = unserialize($_SESSION['Panier']);
                    $Panier->addItem($LeDisque);
                    $_SESSION['Panier'] = serialize($Panier);
                    echo '<h3 class="centré"> Article ajouté au panier</h3>';
                }
    
    
                //Affiche la description complete du disque
                $laCouverture = $LeDisque->getCouvertureMax();
                $leTitre = $LeDisque->getTitre();
                $lAuteur = $LeDisque->getAuteur();
                $leGenre = $LeDisque->getGenre();
                $lePrix = $LeDisque->getPrix();
                print(" <img id=\"couverture\" src=\"$laCouverture\">
                        <div id=\"description\">
                        <p>Titre : $leTitre</p>
                        <p>Auteur : $lAuteur</p>
                        <p>Genre : $leGenre</p>
                        <p>Prix : $lePrix €</p>
                        </div>
                        <form id=\"ajoutPanier\" method=\"post\">
                            <input class=\"bouton\" type=\"submit\" name=\"panier\" class=\"button\" value=\"Ajouter au panier\" />
                        </form>");
            ?>
            </div>
        </body>
    </html>

