<?php


    print("<!DOCTYPE html>
    <html>
        <head>
            <meta charset=\"UTF-8\">
            <title>Acceuil</title>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"Acceuil.css\" />
        </head>
        <body>
            <header>
                <h1>Achat de titre</h1>
            </header>
            <ul>");

    $bdd = "dnunez_pro";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "dnunez_pro";
    $pass = "dnunez_pro";

    $connPDO = new PDO ('mysql:host='.$host.';dbname='.$bdd, $user, $pass);
    $result = $connPDO->query("SELECT * FROM VentesCD");


    while ($tuple = $result->fetch()) {
        print("<li><img src=$tuple[4] height=\"150\" width=\"150\">
        <p>$tuple[0]</p>
        <p>$tuple[1]</p>
    </li>");
    }

    $result->closeCursor();

    print("</ul>
    </body>
</html>");
?>