<?php 
declare(strict_types=1); 
?> 
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8> 
        <title>Videotheek - login</title> 
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="m-5">
            <h1>Videotheek</h1>
            <div class="my-5">
                <form action="./login.php?action=process" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Gebruikersnaam: </label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-5">
                        <label for="password" class="form-label">Passwoord: </label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
        <?php
          if($error){
        ?>                  
                    <p class="text-danger"><?php echo $error; ?></p>

        <?php
          }
        ?>                  
    
            </div>
    </body>
</html>
