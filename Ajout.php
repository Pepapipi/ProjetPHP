<?php 
/*ON DOIT MODIFIER CE FICHIER POUR L'IMPORT DES IMAGES */
    include "Disc.php";
    $bdd = "dnunez_pro";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "dnunez_pro";
    $pass = "dnunez_pro";

    try{
    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);
    }
    catch(PDOException $error)
    {
        echo 'Echec de la connexion';
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nomAlbum = $_POST["nomAlbum"]; 
        $nomArtiste = $_POST["nomArtiste"];
        $genre = $_POST["nomGenre"];
        $prix = $_POST["prix"];

        /*Expression régulière, indiquant qu'il faut rentrer uniquement une chaine de caractères avec 
        uniquement des lettres sans accent, et la première lettre doit être en majuscule. Exemple : Lumiere */

        $pattern = "/^[A-Z]([a-z]+)/";

        /*Expression régulière, indiquant qu'il faut rentrer obligatoirement au moins un caractère, autre que " " */
        $pattern2= "/^([a-zA-z]|[0-9])+.*/";

        /*Arrondi le prix s'il l'utilisteur a ajouté plusieurs chiffres après la virgule
        Exemple : 15.48678 -> 15.49 */
        $prixA=round($prix,2);

        //Recupere l'extension du fichier 
        $extensionObligatoire = 'jpg';
        $filename= $_FILES['photo']['name'];
        $extensionFichier = pathinfo($filename,PATHINFO_EXTENSION);

        //Création images (Min, Max)
        /*var_dump($_FILES['photo']['tmp_name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], "./upload/".$_FILES['photo']['name']);*/
        

        


        /*Ajoute le disque si toutes les conditions sont respectées, c'est à dire:
        Le nom de l'album, le nom de l'artiste ne soit pas vide (et qu'il n'est pas un caractère " ")
        Que l'administateur n'ait mit que des chiffres dans le prix
        Que le prix soit supérieur à 0
        Que le format est respecté
        */
        if (preg_match($pattern2, $nomAlbum) & preg_match($pattern2, $nomArtiste) & preg_match($pattern, $genre) & $prixA > 0 & $extensionObligatoire==$extensionFichier)
        {
            
            // On récupère l'image uploadé par l'utilisateur, on l'a redimensionne et on l'enregistre en deux versions min 150x150 et normal 544x544
            $size = GetImageSize($_FILES['photo']['tmp_name']);
            $src_w = $size[0]; $src_h = $size[1];
            $image_min = ImageCreate(150,150);
            $image_min = ImageCreateTrueColor(150,150);
            $image_max = ImageCreate(544,544);
            $image_max = ImageCreateTrueColor(544,544);
            
            $src_im_min = ImageCreateFromJpeg($_FILES['photo']['tmp_name']);
            $src_im_max = ImageCreateFromJpeg($_FILES['photo']['tmp_name']);

            ImageCopyResampled($image_min,$src_im_min,0,0,0,0,150,150,$src_w,$src_h);
            ImageCopyResampled($image_max,$src_im_max,0,0,0,0,544,544,$src_w,$src_h);

            ImageJpeg($image_min,"./images/".$_FILES['photo']['name']);//Image minimum
            ImageJpeg($image_max,"./images/".basename($_FILES['photo']['name'],".jpg")."_Max.jpg");//Image maximum

            ImageDestroy($image_min);
            ImageDestroy($image_max);
            ImageDestroy($src_im_min);
            ImageDestroy($src_im_max);
            $unDisque = new Disc($nomAlbum,$nomArtiste,$genre,$prixA,basename($_FILES['photo']['name'],".jpg"));
            $unDisque->DiscToBDPDO($connPDO);

        }
        else
        {
            echo '<body onLoad="alert(\'Veuillez vérifier vos saisies\')">';
        }
        
      }
    echo '<meta http-equiv="refresh" content="0;URL=ajoutSupp.php">';
?>
