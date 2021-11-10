<?php
header("Content-type: image/jpeg");
$bdd = "dnunez_pro";
$host = "lakartxela.iutbayonne.univ-pau.fr";
$user = "dnunez_pro";
$pass = "dnunez_pro";
$nomtable = "VentesCD";
$link = mysqli_connect($host,$user,$pass,$bdd) or die("Tristesse dans ce monde... Tu ne peux pas te connecter à la bd");

if (!mysqli_connect_errno())
{
    
}

?>