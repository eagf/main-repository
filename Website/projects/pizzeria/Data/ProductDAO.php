<?php
declare(strict_types=1);

require_once('Data/autoloader.php');

class ProductDAO extends BaseDAO
{
    public function getAll(): ?array
    {
        try {
            $dbh = $this->db_connect();
            $resultSet = $dbh->query("select * from producten");
            $lijst = array();
        foreach ($resultSet as $rij) {
            $product = new Product(
                (int) $rij["productId"],
                $rij["productNaam"],
                (float) $rij["productPrijs"],
                (float) $rij["productPromotieprijs"],
                $rij["productSamenstelling"],
                (bool) $rij["productBeschikbaarheid"]
            );
            array_push($lijst, $product); 
        }
        $dbh = null;
        return $lijst;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function getProductByProductId(int $productId): ?Product
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select * from producten where productId = :productId";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":productId", $productId);
            $stmt->execute();
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $product = new Product(
                (int) $rij["productId"],
                $rij["productNaam"],
                (float) $rij["productPrijs"],
                (float) $rij["productPromotieprijs"],
                $rij["productSamenstelling"],
                (bool) $rij["productBeschikbaarheid"]
            );
            $dbh = null;
            return $product;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
}