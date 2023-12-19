<?php
//pizza.php

// $aantal zal normaal gezien door de gebruiker kunnen ingegeven worden i.p.v. dat het ingesteld wordt in dit programma en $prijs zal uit de database komen i.p.v. dat het hier wordt ingesteld

$aantal = 2;    //expressie
$prijs = 6.5;    //expressie

$gratisThuisbezorging = false;    //expressie


if ($aantal * $prijs > 10.0) {    //2 expressies
    $gratisThuisbezorging = true;    //expressie
}
if ($gratisThuisbezorging) {    //expressie
    print("Uw pizza wordt gratis bezorgd.");
} else {
    print("Thuislevering kost 1 euro.");
}

/*De bedoeling van dit programma: pizza's worden gratis thuis geleverd als het totale betaalde bedrag €10 overschrijdt.*/
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizza</title>
    </head>
    <body>

    </body>
</html>
