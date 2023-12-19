<?php
//registreerGebruiker.php
declare(strict_types=1);

require_once 'GebruikerLijst.php';
$msg = "";

if (isset($_GET["action"]) && $_GET["action"] === "registreer") {
	if ($_POST["wachtwoord1"] === $_POST["wachtwoord2"]) {
		$gebruikerslijst = new GebruikerLijst();
		if (!$gebruikerslijst->emailExists($_POST["email"])){  //bestaat het emailadres al?
			$gebruikerslijst->createGebruiker($_POST["naam"], $_POST["email"], $_POST["wachtwoord1"]);
			$msg = "Je account werd geregistreerd";
		}
		else {$msg = "Dit emailadres bestaat reeds";}
	}
	else {$msg = "Wachtwoorden komen niet overeen";}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registreer</title>
  </head>
  <body>
	  <h1>Registreer</h1>
      <div>
        <form action="registreerGebruiker.php?action=registreer" method="post">
			Naam : <input type="text" name="naam" required /><br>
			E-mail : <input type="email" name="email" required /><br>
			Wachtwoord : <input type="password" name="wachtwoord1" required /><br>
			Wachtwoord (bevestig) : <input type="password" name="wachtwoord2" required /><br><br>
            <input type="submit" value="Registreer" />
        </form><br>
		  <a href="loginGebruiker.php">Login</a>
      </div>
             <h3><?php echo $msg; ?></h3>
  </body>
</html>