<?php
//modulebroodjeOverzicht.php
declare(strict_types=1);
session_start();

require_once 'BroodjeLijst.php';
require_once 'BestellingLijst.php';

if (!isset($_SESSION["gebruiker"])){
   header("location: loginGebruiker.php");
}
$Gebruiker = unserialize($_SESSION["gebruiker"]);
$geplaatst = false;

if (isset($_GET["action"]) && $_GET["action"] === "bestel") {
	$gebrid = $Gebruiker->getId();
	$bestellinglijst = new BestellingLijst();
	$bestellinglijst->createBestelling($gebrid,(int)$_GET["id"]);
	$geplaatst = true;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Broodjes</title>
  </head>
  <body>
     <section>
        <?php
		$broodjelijst = new BroodjeLijst();
        $tab = $broodjelijst->getLijst();
        ?>
      <div>
            <h1>Broodjes</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Omschrijving</th>
                        <th scope="col">Prijs</th>                        
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($tab as $broodje) {
                ?>
                    <tr>
                        <td><?php print($broodje->getNaam());?></td>
						<td><?php print($broodje->getOmschrijving());?></td>
						<td><?php print($broodje->getPrijs());?></td>
						<?php if ($Gebruiker->getgeblokkeerd() === 0) { ?>
                        <td><a href="broodjeOverzicht.php?action=bestel&id=<?php print($broodje->getId()); ?>">Bestel</a></td> 
						<?php } ?>
                    </tr>                    
                <?php
            }
            ?>
                </tbody>
          </table><br>
		  <a href="bestellingOverzicht.php">Besteloverzicht</a>
        </div>        
      </section>  
          <?php if ($geplaatst) { ?> 
             <h3>Je broodje is besteld</h3>
          <?php } ?> 	  
    </body>
</html>