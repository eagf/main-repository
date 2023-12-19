<?php
//puntenOverzicht.php
declare(strict_types=1);

require_once 'PuntLijst.php';
require_once 'ModuleLijst.php';
require_once 'PersoonLijst.php';

$baseUrl = basename($_SERVER['PHP_SELF']);  // bij het laden van de pagina heb je een clean url, bewaar deze in een variabele
//wanneer je een formulier gepost hebt dan zijn de get-velden achteraan de url ingevuld; de bedoeling is om deze weg te laten na het posten van het fomulier, dit doen we via header/location, we laden dan opnieuw de clean url

$puntlijst = new PuntLijst();

//nog uitwerken dat je geen lege punten kan toevoegen!
if (isset($_GET["action"]) && $_GET["action"] === "add") {
    if ($puntlijst->puntBestaat((int) $_POST["selModules"], (int) $_POST["selPersonen"]) === false) {
        $puntlijst->createPunt((int) $_POST["selModules"], (int) $_POST["selPersonen"], (int) $_POST["punt"]);
        
        header("location:{$baseUrl}");    // herlaad de pagina (zonder get-variabelen)
    }
    else {$msg = "exists";}
}

if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    $puntlijst->deletePunt((int)$_GET["id"]);
    
    header("location:{$baseUrl}");    // herlaad de pagina (zonder get-variabelen)
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Punten</title>
  </head>
  <body>
<?php include_once("nav.php"); ?>
    <section>
        <?php
        $tab = $puntlijst->getAllePuntenSortModuleLijst();
        ?>          
      <div>
            <h1>Puntenoverzicht per module</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col">Naam</th>
                        <th scope="col">Score</th>
                        <th scope="col"></th>
                        <th scope="col"></th>                        
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($tab as $punt) {
                ?>                    
                    <tr>
                        <td><?php print $punt->getModule()->getNaam();?></td>
                        <td><?php print $punt->getPersoon()->getNaam();?></td>
                        <td><?php print $punt->getPunt();?></td>
                        <td><a href="puntBewerken.php?id=<?php print $punt->getId();?>">bewerken</a></td>
                        <td><a href="puntenOverzicht.php?action=delete&id=<?php print($punt->getId()); ?>">delete</i></a></td>                        
                    </tr>
                <?php
            }
            ?>                    
                </tbody>
          </table>
        </div>
        </section>
        <section>
        <?php
          $tab = $puntlijst->getAllePuntenSortPersoonLijst();
        ?>    
      <div>
            <h1>Puntenoverzicht per persoon</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Module</th>
                        <th scope="col">Score</th>
                        <th scope="col"></th>
                        <th scope="col"></th>                        
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($tab as $punt) {
                ?>                    
                    <tr>
                        <td><?php print $punt->getPersoon()->getNaam();?></td>
                        <td><?php print $punt->getModule()->getNaam();?></td>
                        <td><?php print $punt->getPunt();?></td>
                        <td><a href="puntBewerken.php?id=<?php print $punt->getId();?>">bewerken</a></td>
                        <td><a href="puntenOverzicht.php?action=delete&id=<?php print($punt->getId()); ?>">delete</i></a></td>                        
                    </tr>
                <?php
            }
            ?>                    
                </tbody>
          </table>
        </div>        
    </section>      
      
      
        <section class="overzicht">
        <?php 
           $modulelijst = new ModuleLijst();
           $tabmodule = $modulelijst->getLijst();
           $persoonlijst = new PersoonLijst();
           $tabpersoon = $persoonlijst->getLijst();        
        ?>   
      <div>      
        <h1>Punten toevoegen</h1>
        <form action="puntenOverzicht.php?action=add" method="post">
           <select name="selModules">
               <?php foreach ($tabmodule as $module) { ?>
                  <option value="<?php print $module->getId(); ?>"><?php print $module->getNaam(); ?></option>
               <?php } ?>
           </select>
           <select name="selPersonen">
               <?php foreach ($tabpersoon as $persoon) { ?>
                  <option value="<?php print $persoon->getId(); ?>"><?php print $persoon->getNaam(); ?></option>
               <?php } ?>
           </select>
            Punt : <input type="number" name="punt" min="0" max="100" /><br /><br />
            <input type="submit" value="Toevoegen" />
        </form><br>
          <?php if (isset($msg) && ($msg === "exists"))   { ?> 
             <div>Deze punten werden reeds ingevoerd!</div>
          <?php } ?>
            </div>
      </section>
    </body>
</html>