<?php
//puntBewerken.php

declare(strict_types=1);
require_once("PuntLijst.php");

$updated = false;
if (isset($_GET["action"]) && $_GET["action"] === "update") {
   $puntLijst = new PuntLijst();
   $puntLijst->updatePunt((int) $_GET["id"], (int) $_POST["punt"]);
   $updated = true;
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
            <h1>Punt bewerken</h1>            
        <?php
        $puntLijst = new PuntLijst();
        $punt = $puntLijst->getPuntById((int) $_GET["id"]);
        ?>
       <div>Module : <?php print $punt->getModule()->getNaam();?></div>
       <div>Naam : <?php print $punt->getPersoon()->getNaam();?></div>
        <form action="puntBewerken.php?action=update&id=<?php print($_GET["id"]); ?>" method="post">
            Punt : <input type="number" name="punt" min="0" max="100" value="<?php print $punt->getPunt();?>" /><br /><br />
            <input type="submit" value="Opslaan" />
        </form><br>    
          <?php if (isset($updated) && ($updated === true))   { ?> 
             <div>Record bijgewerkt</div>
          <?php } ?> 

        </div>        
    </section>
    </body>
</html>