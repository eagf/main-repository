<?php
//bestellingOverzicht.php
declare(strict_types=1);

require_once 'BestellingLijst.php';
require_once 'BroodjeLijst.php';
require_once 'GebruikerLijst.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bestellingen</title>
  </head>
  <body>
     <section>
        <?php
		 $bestellinglijst = new BestellingLijst();
         $tab = $bestellinglijst->getLijst();
        ?>          
      <div>
            <h1>Bestellingen</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Broodje</th>
                        <th scope="col">Omschrijving</th>
                        <th scope="col">Gebruiker</th>
                        <th scope="col">Datumtijd</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($tab as $bestelling) {
                ?>                    
                    <tr>
                        <td><?php print $bestelling->getBroodje()->getNaam();?></td>
						<td><?php print $bestelling->getBroodje()->getOmschrijving();?></td>
                        <td><?php print $bestelling->getGebruiker()->getNaam();?></td>
                        <td><?php print $bestelling->getDatumtijd();?></td>
                    </tr>
                <?php
            }
            ?>                    
                </tbody>
          </table><br>
		  <a href="broodjeOverzicht.php">Broodjesoverzicht</a>
        </div>
        </section>
    </body>
</html>