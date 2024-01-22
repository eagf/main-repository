<?php
    declare(strict_types=1);
?>
<!DOCTYPE HTML>
<!-- presentation/nieuwboekForm.php -->
<html>
    <head>
            <meta charset=utf-8>
            <title>Boeken</title>
    </head>
    <body>
            <h1>Nieuw boek toevoegen</h1>
            <?php
            if (isset($error) && ($error === "titelbestaat")) {
            ?>
                <p style="color: red">Titel bestaat al!</p>
            <?php
            }
            ?>


            <form method="post" action="voegboektoe.php?action=process">
                    <table>
                            <tr>
                                    <td>Titel:</td>
                                    <td>
                                            <input type="text" name="txtTitel" />
                                    </td>
                            </tr>
                            <tr>
                                    <td>Genre:</td>
                                    <td>
                                            <select name="selGenre">
                                                    <?php
                                                    foreach ($genreLijst as $genre) {
                                                            ?>
            <option value="<?php print($genre->getId());?>"> 
                    <?php print($genre->getGenreNaam());?></option>
                                                            <?php
                                                            }
                                                    ?>
                                            </select>
                                    </td>
                            </tr>
                            <tr>
                                    <td></td>
                                    <td>
                                            <input type="submit" value="Toevoegen" />
                                    </td>
                            </tr>
                    </table>
            </form>
    </body>
</html>

