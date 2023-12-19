<?php 
session_start(); 
unset($_SESSION["gebruiker"]); 
// einde van de pagina-specifieke logica 

// start van de HTML 
require_once("header.php"); 
?> 

<h1>Logout</h1> 
<h2>U bent uitgelogd</h2> 

<?php 
// einde van de HTML 
require_once("footer.php"); 
?>