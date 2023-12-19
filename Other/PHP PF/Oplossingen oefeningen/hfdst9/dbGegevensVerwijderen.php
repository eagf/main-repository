<?php
//dbGegevensVerwijderen.php 
declare(strict_types=1);
class ModuleLijst
{
    public function getLijst(): array
    {
        $sql = "select id, naam, prijs from modules order by naam";
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["id"], $rij["naam"], (float) $rij["prijs"]);
            array_push($lijst, $module);
        }
        $dbh = null;
        return $lijst;
    }
    public function deleteModule(int $id)
    {
        $sql = "delete from modules where id = :id";
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}
class Module
{
    private int $id;
    private string $naam;
    private float $prijs;
    public function __construct(int $id, string $naam, float $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getNaam(): string
    {
        return $this->naam;
    }
    public function getPrijs(): float
    {
        return $this->prijs;
    }
}
$modLijst = new ModuleLijst();

if (isset($_GET["action"]) && ($_GET["action"] === "verwijder")) {
    $modLijst->deleteModule((int) $_GET["id"]);
}
$tab = $modLijst->getLijst(); ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Modules</title>
</head>

<body>
    <h1>Modules</h1>
    <ul>
        <?php foreach ($tab as $module) { ?>
            <li>
                <?php echo $module->getNaam(); ?> <a
                    href="dbGegevensVerwijderen.php?action=verwijder&id= <?php echo $module->getId(); ?>">Verwijderen</a>
            </li>
        <?php } ?>
    </ul>
</body>

</html>