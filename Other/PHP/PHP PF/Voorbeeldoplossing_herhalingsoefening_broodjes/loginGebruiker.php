<?php
//loginGebruiker.php
declare(strict_types=1);
session_start();

require_once 'GebruikerLijst.php';
$loginGefaald = false;

if (isset($_GET["action"]) && $_GET["action"] === "login") {
	$gebruikerslijst = new GebruikerLijst();
	$Gebruiker = $gebruikerslijst->loginGebruiker($_POST["email"], $_POST["wachtwoord"]);
	//$Gebruiker bevat ofwel false, ofwel is het een Gebruiker
    if ($Gebruiker !== false){  
		$_SESSION["gebruiker"] = serialize($Gebruiker);  // bewaar de Gebruiker in een sessie
		setcookie("email", $_POST["email"]);
		header("location: broodjeOverzicht.php");
	}
	else $loginGefaald = true;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>
  <body>
	  <h1>Login</h1>
      <div>
        <form action="loginGebruiker.php?action=login" method="post">
			E-mail : <input type="email" name="email" required value="<?php if (isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" /><br>
			Wachtwoord : <input type="password" name="wachtwoord" required autofocus /><br><br>
            <input type="submit" value="Login" />
        </form><br>
		  <a href="registreerGebruiker.php">Registreer</a>
      </div>
          <?php if ($loginGefaald) { ?> 
             <h3>Login is niet gelukt</h3>
          <?php } ?> 	  
  </body>
</html>