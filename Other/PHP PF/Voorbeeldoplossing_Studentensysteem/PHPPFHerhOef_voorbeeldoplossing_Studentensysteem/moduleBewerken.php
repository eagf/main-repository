<?php
//moduleBewerken.php

declare(strict_types=1);
require_once("ModuleLijst.php");

$updated = false;
if (isset($_GET["action"]) && $_GET["action"] === "update") {
    
   $moduleLijst = new ModuleLijst();
  if ($moduleLijst->getModuleByNaam(trim($_POST["naam"])) === false) {  
    $module = new Module((int) $_GET["id"], $_POST["naam"]);
    $moduleLijst->updateModule($module);
    $updated = true;
    
     }
    else {$msg = "exists";}    
 
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
           <div>
            <h1>Module bewerken</h1>            
        <?php
        $moduleLijst = new ModuleLijst();
        $module = $moduleLijst->getModuleById((int) $_GET["id"]);
        ?>
        <form action="moduleBewerken.php?action=update&id=<?php print($_GET["id"]); ?>" method="post">
            Naam:
            <input type="text" name="naam" value="<?php print($module->getNaam()); ?>" /> <br /><br />
            <input type="submit" value="Opslaan" />
        </form><br>    
          <?php if (isset($updated) && ($updated === true))   { ?> 
             <div>Record bijgewerkt</div>
          <?php } ?> 
          <?php if (isset($msg) && ($msg === "exists"))   { ?> 
             <div>Deze module bestaat reeds</div>
          <?php } ?>                 
        </div>        
    </section>  
    </body>
</html>