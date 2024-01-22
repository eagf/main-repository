<?php
//persoonOverzicht.php

declare(strict_types=1);

require_once 'PersoonLijst.php';
require_once 'PuntLijst.php';

$baseUrl = basename($_SERVER['PHP_SELF']);  // bij het laden van de pagina heb je een clean url, bewaar deze in een variabele
//wanneer je een formulier gepost hebt dan zijn de get-velden achteraan de url ingevuld; de bedoeling is om deze weg te laten na het posten van het fomulier, dit doen we via header/location, we laden dan opnieuw de clean url

$persoonlijst = new PersoonLijst();
if (isset($_GET["action"]) && $_GET["action"] === "add") {
    if ($persoonlijst->getPersoonByNaam(trim($_POST["naam"])) === false) {
        $persoonlijst->createPersoon($_POST["naam"]);
        
        header("location:{$baseUrl}");    // herlaad de pagina (zonder get-variabelen)
    }
    else {$msg = "exists";}
}

if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    $puntlijst = new PuntLijst();
    $punt = $puntlijst->getPuntenPerPersoonLijst((int)$_GET["id"]);
    if (empty($punt)) {
       $persoonlijst->deletePersoon((int)$_GET["id"]);
        
        header("location:{$baseUrl}");    // herlaad de pagina (zonder get-variabelen)
    }
    else {$msg="dependency";}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Punten</title>
  </head>
  <body>
<?php include_once("nav.php"); ?>
        <section>
        <?php
        $tab = $persoonlijst->getLijst();
        ?>
      <div>
            <h1>Alle personen</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Persoon</th>
                        <th scope="col"></th>
                        <th scope="col"></th>                        
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($tab as $persoon) {
                ?>
            <tr>
                <td><?php print($persoon->getNaam());?></td>
                <td><a href="persoonBewerken.php?id=<?php print($persoon->getId());?>">bewerken</a></td>
                <td><a href="persoonOverzicht.php?action=delete&id=<?php print($persoon->getId()); ?>">delete</a></td>                        
            </tr>                        
                    
                <?php
            }
            ?>
                </tbody>
          </table>
        </div>        
    </section>                     
    <section>                    
      <div>      
        <h1>Persoon toevoegen</h1>
        <form action="persoonOverzicht.php?action=add" method="post">
            Naam : <input type="text" name="naam" /><br /><br />
            <input type="submit" value="Toevoegen" />
        </form><br>
          <?php if (isset($msg) && ($msg === "dependency"))   { ?> 
             <div>Deze persoon wordt gebruikt in Punten</div>
          <?php } ?>  
          <?php if (isset($msg) && ($msg === "exists"))   { ?> 
             <div>Deze persoon bestaat reeds</div>
          <?php } ?>            
    </div>    
      </section>
    </body>
</html>