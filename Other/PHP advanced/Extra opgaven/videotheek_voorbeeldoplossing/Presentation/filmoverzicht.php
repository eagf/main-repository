<?php 
declare(strict_types=1); 
?> 
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8> 
        <title>Videotheek</title> 
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand fs-4" href="./filmoverzicht.php">
                    <i class="bi bi-film"></i>
                </a>
                <div class="d-flex">
                <h3 class="text-light mt-1 mx-3"> <?php 
                    echo $_SESSION["user"];
                    ?></h3>
                    <a class="navbar-brand fs-4" href="./login.php">
                        <i class="bi bi-arrow-right-square"></i>
                    </a>
                </div>
            </div>
        </nav>
        <div class="m-5">
            <h1>Videotheek</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Titel</th>
                        <th scope="col">Nummer(s)</th>
                        <th scope="col">Exemplaren aanwezig</th>
                    </tr>
                </thead>
                <tbody>
        <?php
 /*                   echo "<pre>";
                    var_dump($filmItems);
                    echo "</pre>";
                    echo "<br><br>";*/
          foreach($filmItems as $filmItem){
/*                    echo "<pre>";
                    var_dump($filmItem->getFilm()->getTitle());
                    echo "</pre>";*/
        ?>                    
                        <tr>
                            <td>
                                <?php echo $filmItem->getFilm()->getTitle(); ?>
                            </td>
                            <td>

                                <?php 
        
                      foreach($filmItem->getExemplaren() as $exemplaar){ 
                                
                                ?>
                                <span>
                                 
                                    <?php if($exemplaar->getAanwezig()) { ?>
                                    <b>
                                
                                        <?php } ?>
                                     
                                        <?php echo $exemplaar->getExemplaarId(); ?>
                               
                                         <?php if($exemplaar->getAanwezig()) { ?>
                                    </b>
                                
                                    <?php } ?>
                               
                                    <?php } ?>
                                </span>
                            </td>
                            <td>
                                <?php 
              //echo $exemplaar->getExemplarenAanwezigCount();
              echo $filmItem->getExemplarenAanwezigCount();
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php
          if($error){
        ?>                  
                    <p class="text-danger"><?php echo $error; ?></p>

        <?php
          }
        ?> 

            <!-- Add film -->
            <div class="btn-group" role="group">
                <button id="btnActionsGroup" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Acties
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addFilmBackdrop" href="">Add film titel</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addExemplaarBackdrop" href="">Add exemplaar</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteFilmBackdrop" href="">Delete film</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteExemplaarBackdrop" href="">Delete exemplaar</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#rentExemplaarBackdrop" href="">Huur exemplaar</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#returnExemplaarBackdrop" href="">Exemplaar terugbrengen</a></li>
					<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#zoekExemplaarBackdrop" href="">Zoek exemplaar</a></li>
                </ul>
             </div>

            <!-- Add film -->
            <div class="modal fade" id="addFilmBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <form action="./filmoverzicht.php?action=addfilm" method="POST">
                                <div class="modal-body">
                                    <div class="input-group">
                                        <span class="input-group-text">Titel</span>
                                        <input type="text" aria-label="titel" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" type="submit" value="Add film"/>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>

            <!-- Add exemplaar -->
            <div class="modal fade" id="addExemplaarBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Exemplaar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="./filmoverzicht.php?action=addExemplaar" method="POST">
                            <div class="modal-body">
                                <div class="input-group">
                                    <span class="input-group-text">Film Titel</span>
                                    <select name="filmId" id="filmId">
                                    <?php foreach($filmItems as $filmItem){ ?>
                                     <option value="<?php echo $filmItem->getFilm()->getFilmId(); ?>"><?php echo $filmItem->getFilm()->getTitle() ?></option>   
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" type="submit" value="Add exemplaar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Delete Film-->
            <div class="modal fade" id="deleteFilmBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Film</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="./filmoverzicht.php?action=deleteFilm" method="POST">
                            <div class="modal-body">
                                <div class="input-group">
                                    <span class="input-group-text">Film Titel</span>
                                    <select name="filmId" id="filmId">
                                    <?php foreach($filmItems as $filmItem){ ?>
                                    <option value="<?php echo $filmItem->getFilm()->getFilmId(); ?>"><?php echo $filmItem->getFilm()->getTitle() ?></option> 
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" type="submit" value="Delete film"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Exemplaar-->
            <div class="modal fade" id="deleteExemplaarBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Exemplaar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="./filmoverzicht.php?action=deleteExemplaar" method="POST">
                            <div class="modal-body">
                                <div class="input-group">
                                    <span class="input-group-text">Exemplaar ID</span>
                                    <input type="number" aria-label="exemplaarId" name="exemplaarId" class="form-control" min="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" type="submit" value="Delete exemplaar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="rentExemplaarBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Huur Exemplaar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="./filmoverzicht.php?action=rentFilm" method="POST">
                            <div class="modal-body">
                                <div class="input-group">
                                    <span class="input-group-text">Exemplaar ID</span>
                                    <input type="number" aria-label="exemplaarId" name="exemplaarId" class="form-control" min="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" type="submit" value="Huur exemplaar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="returnExemplaarBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Exemplaar terugbrengen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="./filmoverzicht.php?action=returnFilm" method="POST">
                            <div class="modal-body">
                                <div class="input-group">
                                    <span class="input-group-text">Exemplaar ID</span>
                                    <input type="number" aria-label="exemplaarId" name="exemplaarId" class="form-control" min="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" type="submit" value="Exemplaar terugbrengen"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			
            <div class="modal fade" id="zoekExemplaarBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Zoek exemplaar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="./filmoverzicht.php?action=zoekExemplaar" method="POST">
                            <div class="modal-body">
                                <div class="input-group">
                                    <span class="input-group-text">Exemplaar ID</span>
                                    <input type="number" aria-label="exemplaarId" name="exemplaarId" class="form-control" min="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" type="submit" value="Zoek exemplaar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>			

        </div>
    </body>
</html>
