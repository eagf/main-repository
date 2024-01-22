<?php

declare(strict_types=1);

namespace Data;

use Data\BaseDAO;
use \PDO;

use Entities\Bestelling;
use Entities\Broodje;
use Entities\Beleg;

use Exceptions\TeLaatException;
use Exceptions\GeenBestellingenException;

class BestellingDAO extends BaseDAO
{
    public function create(int $klantid, int $broodjeid, array $belegSoorten, int $valseTijd)
    {
        try {
            if ((date("H:i") >= "10:00") && $valseTijd === 0) {
                throw new TeLaatException();
            }
            $dbh = $this->db_connect();
            $sql = "INSERT INTO bestellingen (klantid, datumtijd) VALUES (:klantid, :datumtijd)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":klantid", $klantid);
            $datumtijd = date("Y-m-d H:i:sa");
            $stmt->bindValue(":datumtijd", $datumtijd);
            $stmt->execute();

            $laatsteNieuweId = $dbh->lastInsertId();

            $sql = "INSERT INTO bestellingendetail (bestelid, broodjeid) VALUES (:bestelid, :broodjeid)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":bestelid", $laatsteNieuweId);
            $stmt->bindValue(":broodjeid", $broodjeid);
            $stmt->execute();

            $laatsteNieuweId = $dbh->lastInsertId();

            foreach ($belegSoorten as $belegid) {
                $sql = "INSERT INTO belegdetail (besteldetailid, belegid) VALUES (:besteldetailid, :belegid)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(":besteldetailid", $laatsteNieuweId);
                $stmt->bindValue(":belegid", $belegid);
                $stmt->execute();
            }
            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
    public function getBestellingenByKlantId(int $klantid): ?array
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select * from bestellingen where klantid = :klantid";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":klantid", $klantid);
            $stmt->execute();
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$resultSet) {
                throw new GeenBestellingenException();
            }

            $lijst = array();
            foreach ($resultSet as $rij) {
                $beleg = new Bestelling((int) $rij["bestelid"], (int) $rij["klantid"], $rij["datumtijd"]);
                array_push($lijst, $beleg);
            }
            $dbh = null;
            return $lijst;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function getBroodjeByBestelId(int $bestelid): ?Broodje
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select 
            broodjes.broodjeid as broodjeid, 
            broodjes.soort as soort, 
            broodjes.prijs as prijs 
            from broodjes 
            inner join bestellingendetail 
            on broodjes.broodjeid = bestellingendetail.broodjeid
            where bestellingendetail.bestelid = :bestelid";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":bestelid", $bestelid);
            $stmt->execute();
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $broodje = new Broodje((int) $rij["broodjeid"], $rij["soort"], (int) $rij["prijs"]);
            $dbh = null;
            return $broodje;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function getBelegSoortenByBestelId(int $bestelid): array
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select 
            beleg.belegid as belegid,
            beleg.soort as soort,
            beleg.prijs as prijs
            from beleg 
            inner join belegdetail 
            on beleg.belegid = belegdetail.belegid
            inner join bestellingendetail
            on belegdetail.besteldetailid = bestellingendetail.besteldetailid
            where bestellingendetail.bestelid = :bestelid";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":bestelid", $bestelid);
            $stmt->execute();
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $lijst = array();
            foreach ($resultSet as $rij) {
                $beleg = new Beleg((int) $rij["belegid"], $rij["soort"], (int) $rij["prijs"]);
                array_push($lijst, $beleg);
            }
            $dbh = null;
            return $lijst;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
