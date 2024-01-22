<?php 
//boeken.php 
class Boek { 
    public function getTitel() { 
        $titel = "Handleiding HTML"; 
        return $titel; 
        } 
    }
?> 

<!DOCTYPE HTML> 
<html> 
    <head> 
        <meta charset=utf-8> 
        <title>Boeken</title> 
    </head> 
    <body> 
        <h1> 
            <?php 
            $boek = new Boek(); 
            print($boek->getTitel()); 
            ?> 
        </h1> 
    </body> 
</html>