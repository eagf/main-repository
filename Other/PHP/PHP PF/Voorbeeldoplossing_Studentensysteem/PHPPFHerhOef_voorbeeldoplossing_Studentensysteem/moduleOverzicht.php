<?php
//moduleOverzicht.php

declare(strict_types=1);
//session_start();   // dit is nodig voor de sessie-variabele

require_once 'ModuleLijst.php';
require_once 'PuntLijst.php';

$baseUrl = basename($_SERVER['PHP_SELF']);  // bij het laden van de pagina heb je een clean url, bewaar deze in een variabele
//wanneer je een formulier gepost hebt dan zijn de get-velden achteraan de url ingevuld; de bedoeling is om deze weg te laten na het posten van het fomulier, dit doen we via header/location, we laden dan opnieuw de clean url

$modulelijst = new ModuleLijst();

//voeg een nieuwe module toe
if (isset($_GET["action"]) && $_GET["action"] === "add") {
    //$modulelijst->createModule($_POST["naam"]);
    
    if ($modulelijst->getModuleByNaam(trim($_POST["naam"])) === false) {
        $modulelijst->createModule($_POST["naam"]);

        //na het posten van het formulier navigeer je opnieuw naar de basispagina moduleOverzicht.php
        //$_SESSION["msg"] = "toegevoegd";  // hier wordt in een sessievariabele de status 'toegevoegd' bewaard
        header("location:{$baseUrl}");    // herlaad de pagina (zonder get-variabelen)
    
    }
    else {$msg = "exists";}
}

//verwijder een module
if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    
    $puntlijst = new PuntLijst();
    $punt = $puntlijst->getPuntenPerModuleLijst((int)$_GET["id"]);
    if (empty($punt)) {
       $modulelijst->deleteModule((int)$_GET["id"]);
        
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
        <section class="overzicht">
        <?php
        $tab = $modulelijst->getLijst();
        ?>
      <div>
            <h1>Alle modules</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col"></th>
                        <th scope="col"></th>                        
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($tab as $module) {
                ?>
                    <tr>
                        <td><?php print($module->getNaam());?></td>
                        <td><a href="moduleBewerken.php?id=<?php print($module->getId());?>">bewerken</a></td>
                        <td><a href="moduleOverzicht.php?action=delete&id=<?php print($module->getId()); ?>">delete</a></td>                        
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
        <h1>Module toevoegen</h1>
        <form action="moduleOverzicht.php?action=add" method="post">
            Naam : <input type="text" name="naam" /><br /><br />
            <input type="submit" value="Toevoegen" />
        </form><br>
          <?php if (isset($msg) && ($msg === "dependency"))   { ?> 
             <div>Deze module wordt gebruikt in Punten</div>
          <?php } ?>  
          <?php if (isset($msg) && ($msg === "exists"))   { ?> 
             <div>Deze module bestaat reeds</div>
          <?php } ?>  
    </div>    
      </section>
    </body>
</html>