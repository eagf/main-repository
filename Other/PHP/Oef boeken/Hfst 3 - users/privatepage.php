<?php
session_start();
require_once("user.php");

if (!isset($_SESSION["gebruiker"])) {
    header("Location: publicpage.php");
    exit;
}

$gebruiker = unserialize($_SESSION["gebruiker"], ["User"]); 
// einde van de pagina-specifieke logica
?>

<?php
// start van de HTML
require_once("header.php");
?>

<h1>Private page</h1> 
<h2>Welkom <?php echo $gebruiker->getEmail(); ?></h2> 
<p>Enkel toegankelijk voor ingelogde personen!</p>

<?php 
// einde van de HTML 
require_once("footer.php"); 
?>