<?php
//puntenPerModuleOverzicht.php

declare(strict_types=1);
require_once 'PuntLijst.php';
require_once 'ModuleLijst.php';

$puntlijst = new PuntLijst();

if (isset($_GET["action"]) && $_GET["action"] === "viewmodule") {
    $permodule = $puntlijst->getPuntenPerModuleLijst((int) $_POST["selModules"]);
}

//===================================================================

if (isset($_GET["action"]) && $_GET["action"] === "delete") {
  $puntlijst->deletePunt((int)$_GET["id"]);
}

//===================================================================


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
      <div>
            <h1>Punten module</h1>
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
            if (isset($permodule)){
              foreach ($permodule as $punt) {
                ?>
                    
                    <tr>
                        <td><?php print $punt->getModule()->getNaam();?></td>
                        <td><?php print $punt->getPersoon()->getNaam();?></td>
                        <td><?php print $punt->getPunt();?></td>
                        <td><a href="puntBewerken.php?id=<?php print $punt->getId();?>">bewerken</a></td>
                        <td><a href="puntenPerModuleOverzicht.php?action=delete&id=<?php print($punt->getId()); ?>">delete</a></td>                        
                    </tr>                    
                    
                    
                <?php
              }
            }
            ?>
        
                </tbody>
          </table>                    
        </div>
        </section>
<section>                    
      <div>      
        <h1>Zoek module</h1>      
        <?php 
           $modulelijst = new ModuleLijst();
           $tabmodule = $modulelijst->getLijst();
        ?>          
        <form action="puntenPerModuleOverzicht.php?action=viewmodule" method="post">
           <select name="selModules">
               <?php foreach ($tabmodule as $module) { ?>
                  <option value="<?php print $module->getId(); ?>"><?php print $module->getNaam(); ?></option>
               <?php } ?>
           </select>
            <input type="submit" value="Zoek" />
        </form> 
        </div>
        </section>    
    </body>
</html>