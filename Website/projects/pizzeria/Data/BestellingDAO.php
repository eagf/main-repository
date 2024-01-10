<?php

declare(strict_types=1);

require_once('Data/autoloader.php');

class BestellingDAO extends BaseDAO
{
    public function createBestelling(Klant $klant, $bestelInfo, $winkelmandLijst)
    {
        $klantId = $klant->getKlantId();
        $bestelPromo = $klant->getKlantPromo();
        try {
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare(
                "INSERT INTO bestellingen 
                (klantId, 
                bestelDatumTijd, 
                bestelInfo,
                bestelPromo) 
                VALUES 
                (:klantId, 
                :bestelDatumTijd, 
                :bestelInfo,
                :bestelPromo)"
            );
            $stmt->execute(
                array(
                    ':klantId' => $klantId,
                    ':bestelDatumTijd' => date("Y-m-d H:i:sa"),
                    ':bestelInfo' => $bestelInfo,
                    ':bestelPromo' => $bestelPromo
                )
            );

            $bestelId = $dbh->lastInsertId();

            $productSrv = new ProductService();

            foreach ($winkelmandLijst as $winkelmandProduct) {
                $productId = (int) $winkelmandProduct["productId"];
                $productAantal = (int) $winkelmandProduct["aantal"];
                $product = $productSrv->getProductByProductId($productId);
                $bestelPrijs = $product->getProductprijs();
                $bestelPromotieprijs = $product->getProductPromotieprijs(); 
                
                $stmt = $dbh->prepare(
                    "INSERT INTO bestellijnen 
                    (bestelId, 
                    productId, 
                    bestelPrijs,
                    bestelPromotieprijs,
                    productAantal) 
                    VALUES 
                    (:bestelId, 
                    :productId, 
                    :bestelPrijs,
                    :bestelPromotieprijs,
                    :productAantal)"
                );
                $stmt->execute(
                    array(
                        ':bestelId' => $bestelId,
                        ':productId' => $productId,
                        ':bestelPrijs' => $bestelPrijs,
                        ':bestelPromotieprijs' => $bestelPromotieprijs,
                        ':productAantal' => $productAantal
                    )
                );
            }
            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
