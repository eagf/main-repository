<?php
//persoonBewerken.php

declare(strict_types=1);
require_once("PersoonLijst.php");

$updated = false;
if (isset($_GET["action"]) && $_GET["action"] === "update") {
    
    $persoonLijst = new PersoonLijst();
    if ($persoonLijst->getPersoonByNaam(trim($_POST["naam"])) === false) {
        $persoon = new Persoon((int) $_GET["id"], $_POST["naam"]);
        $persoonLijst->updatePersoon($persoon);
        $updated = true;
    }
    else {$msg = "exists";}          
}
?>

<!DOCTYPE html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Punten</title>
  </head>
  <body>
<?php include_once("nav.php"); ?>
        <section>
           <div>
            <h1>Persoon bewerken</h1> 
        <?php
        $persoonLijst = new PersoonLijst();
        $persoon = $persoonLijst->getPersoonById((int) $_GET["id"]);
        ?>
        <form action="persoonBewerken.php?action=update&id=<?php print($_GET["id"]); ?>" method="post">
            Naam:
            <input type="text" name="naam" value="<?php print($persoon->getNaam()); ?>" /> <br /><br />
            <input type="submit" value="Opslaan" />
        </form><br>    
          <?php if (isset($updated) && ($updated === true))   { ?> 
             <div>Record bijgewerkt</div>
          <?php } ?>   
          <?php if (isset($msg) && ($msg === "exists"))   { ?> 
             <div>Deze persoon bestaat reeds</div>
          <?php } ?>                 
        </div>        
    </section> 
    </body>
</html>