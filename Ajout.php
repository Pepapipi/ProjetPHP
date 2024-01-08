<?php 
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
        
        /*L'administratuer peut par mégarde rajouté une virgule au lieu d'un point pour la sépartion
        Alors on remplace dans le prix la , par le . */
        $replaceVigPoint = str_replace(",",".",$prix);
        $prixA=round($replaceVigPoint,2);

        /*Expression régulière indiquant qu'il doit rentrer un prix correct 
        0.89 -> correct    -0.78 -> incorrect
        101 -> correct      10.89 -> correct
        010.4 -> incorrect*/
        
        $pattern3 = "/^(0\.[0-9]{0,2})|([1-9][0-9]*\.[0-9]{0,2})|[1-9][0-9]*/";

        //Recupere l'extension du fichier 
        $extensionObligatoire = 'jpg';
        $filename= $_FILES['photo']['name'];
        $extensionFichier = pathinfo($filename,PATHINFO_EXTENSION);        


        /*Ajoute le disque si toutes les conditions sont respectées, c'est à dire:
        Le nom de l'album, le nom de l'artiste ne soit pas vide (et qu'il n'est pas un caractère " ")
        Que l'administateur ait mis un prix de façon correcte 
        Que le format soit respecté
        */
        if (preg_match($pattern2, $nomAlbum) & preg_match($pattern2, $nomArtiste) & preg_match($pattern, $genre) & preg_match($pattern3, $prixA) & $extensionObligatoire==$extensionFichier & $prixA > 0)
        {
            

            /*On récupère l'image inserer par l'utilisateur, pour ensuite la dupliquer 2 fois en ayant 
            des tailles différentes, et on mettre ces 2 images dans le dossier images */


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

            $albumEtArtiste = $nomAlbum."_".$nomArtiste;
            $nomAlbumEtArtiste = str_replace(" ", "_",$albumEtArtiste);

            ImageJpeg($image_min,"./images/".$nomAlbumEtArtiste.".jpg");//Image minimum
            ImageJpeg($image_max,"./images/".$nomAlbumEtArtiste."_Max.jpg");//Image maximum

            ImageDestroy($image_min);
            ImageDestroy($image_max);
            ImageDestroy($src_im_min);
            ImageDestroy($src_im_max);

            
            $unDisque = new Disc($nomAlbum,$nomArtiste,$genre,$prixA,$nomAlbumEtArtiste);
            $unDisque->DiscToBDPDO($connPDO);

        }
        elseif(!preg_match($pattern, $genre))
        {
            echo '<body onLoad="alert(\'Le genre doit avoir sa première lettre en majuscule, et que la premiere lettre\')">';
        }
        else
        {
            echo '<body onLoad="alert(\'Veuillez vérifier vos saisies\')">';
        }
        
      }
    echo '<meta http-equiv="refresh" content="0;URL=ajoutSupp.php">';
?>
