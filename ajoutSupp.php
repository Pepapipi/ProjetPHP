<!DOCTYPE html>
<h1>Ajouter ou supprimer un titre</h1>
<form method="post">
    <input type="radio" id="ajout" name="ajoutSupp" value="ajout" checked>
    <label for="ajout">Ajouter un titre</label>

    
    <input type="radio" id="supp" name="ajoutSupp" value="supp">
    <label for="supp">Supprimer un titre</label>
</form>
<?php
    if($_POST['ajoutSupp'] == "supp")
    {
        echo 'Supprimer';
    }
    else
    {
        echo 'Ajouter';
    }
?>