<?php
    declare(strict_types=1);
?>
<!DOCTYPE HTML>
<!-- presentation/updateboekForm -->
<html>
	<head>
		<meta charset=utf-8>
		<title>Boeken</title>
	</head>
	<body>
		<h1>Boek bijwerken</h1>
                <?php
                if (isset($error) && $error == "titelbestaat") {
		?>
			<p style="color: red">Titel bestaat al!</p>
		<?php
		}
		?>

		<form method="post" action="updateboek.php?action=process&id= 
			<?php print($boek->getId());?>">
			<table>
				<tr>
					<td>Titel:</td>
					<td>
						<input type="text" name="txtTitel"  
						value="<?php print($boek->getTitel());?>">
					</td>
				</tr>
				<tr>
					<td>Genre:</td>
					<td>
						<select name="selGenre">
							<?php
							foreach ($genreLijst as $genre) {
		if ($genre->getId() == $boek->getGenre()->getId()) {
			$selWaarde = " selected";
		} else {
			$selWaarde = "";
		}
		?>
		<option value="<?php print($genre->getId());?>"<?php  
			print($selWaarde);?>>
			<?php print($genre->getGenreNaam());?>
		</option>
		<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
                                        <td></td>
					<td>
						<input type="submit" value="Bijwerken" />
					</td>
				</tr>
			</table>
		</form>
	</body>
</html> 

