<?php

declare(strict_types=1);

require_once('Data/autoloader.php');

class KlantDAO extends BaseDAO
{
    public function getKlantByKlantId($klantId): ?Klant
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select * from klanten where klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":klantId", $klantId);
            $stmt->execute();
            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$resultSet) {
                throw new NietInDatabaseException();
            }
            $klant = new Klant(
                (int)$resultSet["klantId"],
                $resultSet["klantNaam"],
                $resultSet["klantVoornaam"],
                $resultSet["klantStraat"],
                $resultSet["klantHuisnummer"],
                (int)$resultSet["plaatsId"],
                $resultSet["klantTelefoonnummer"],
                $resultSet["klantEmail"],
                $resultSet["klantWachtwoord"],
                $resultSet["klantInfo"],
                (int)$resultSet["klantPromo"]
            );
            $dbh = null;
            return $klant;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function registreer(
        $naam,
        $voornaam,
        $straat,
        $huisnummer,
        $postcode,
        $telefoonnummer,
        $email,
        $wachtwoord,
        $herhaalwachtwoord,
        $info
    ): ?Klant {
        try {
            $dbh = $this->db_connect();
            if ($email !== "0") {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new OngeldigEmailadresException();
                }
                $stmt = $dbh->prepare("SELECT * FROM klanten WHERE klantEmail = :email");

                $stmt->bindValue(":email", $email);
                $stmt->execute();
                $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($resultSet) {
                    throw new KlantBestaatAlException();
                }
                if ($wachtwoord !== $herhaalwachtwoord) {
                    throw new WachtwoordenKomenNietOvereenException();
                }
                $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
            }
            $plaatsDAO = new PlaatsDAO();
            $plaats = $plaatsDAO->getPlaatsByPostcode($postcode);
            $plaatsId = $plaats->getPlaatsId();
            $stmt = $dbh->prepare(
                "INSERT INTO klanten 
                (klantNaam,
                klantVoornaam,
                klantStraat,
                klantHuisnummer,
                plaatsId,
                klantTelefoonnummer,
                klantEmail,
                klantWachtwoord,
                klantInfo) 
                VALUES 
                (:naam,
                :voornaam,
                :straat,
                :huisnummer,
                :plaatsId,
                :telefoonnummer,
                :email,
                :wachtwoord,
                :info)"
            );
            $stmt->execute(
                array(
                    ':naam' => $naam,
                    ':voornaam' => $voornaam,
                    ':straat' => $straat,
                    ':huisnummer' => $huisnummer,
                    ':plaatsId' => $plaatsId,
                    ':telefoonnummer' => $telefoonnummer,
                    ':email' => $email,
                    ':wachtwoord' => $wachtwoord,
                    ':info' => $info
                )
            );
            $klantId = $dbh->lastInsertId();
            $klant = $this->getKlantByKlantId($klantId);
            $dbh = null;
            return $klant;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function login(string $email, string $wachtwoord): ?Klant
    {
        try {
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("SELECT * FROM klanten WHERE klantEmail = :email");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$resultSet) {
                throw new NietInDatabaseException();
            }
            $isWachtwoordCorrect = password_verify($wachtwoord, $resultSet["klantWachtwoord"]);
            if (!$isWachtwoordCorrect) {
                throw new WachtwoordIncorrectException();
            }
            $klant = $this->getKlantByKlantId($resultSet["klantId"]);
            $dbh = null;
            return $klant;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }
    public function updateWachtwoord($email, $wachtwoord)
    {
        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new OngeldigEmailadresException();
            }

            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("SELECT * FROM klanten WHERE klantEmail = :email");

            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$resultSet) {
                throw new NietInDatabaseException();
            }

            $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $stmt = $dbh->prepare("UPDATE klanten SET klantWachtwoord = :wachtwoord where klantEmail = :email");
            $stmt->execute(
                array(
                    ":email" => $email,
                    ":wachtwoord" => $wachtwoord
                )
            );
            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function updateKlant(
        $naam,
        $voornaam,
        $straat,
        $huisnummer,
        $postcode,
        $telefoonnummer,
        $info,
        $klantId
    ): ?Klant {
        try {
            $dbh = $this->db_connect();
            $plaatsDAO = new PlaatsDAO();
            $plaats = $plaatsDAO->getPlaatsByPostcode($postcode);
            $plaatsId = $plaats->getPlaatsId();
            $sql = "UPDATE klanten SET 
            klantNaam = :naam, 
            klantVoornaam = :voornaam,
            klantStraat = :straat,
            klantHuisnummer = :huisnummer,
            plaatsId = :plaatsId,
            klantTelefoonnummer = :telefoonnummer,
            klantInfo = :info 
            WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(
                array(
                    ':naam' => $naam,
                    ':voornaam' => $voornaam,
                    ':straat' => $straat,
                    ':huisnummer' => $huisnummer,
                    ':plaatsId' => $plaatsId,
                    ':telefoonnummer' => $telefoonnummer,
                    ':info' => $info,
                    ':klantId' => $klantId
                )
            );
            $klant = $this->getKlantByKlantId($klantId);
            $dbh = null;
            return $klant;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
    public function toggleKlantPromoByKlantId($klantId): ?Klant
    {
        try {
            $dbh = $this->db_connect();
            $sql = "SELECT klantPromo FROM klanten WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':klantId' , $klantId);
            $stmt->execute();
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $klantPromo = $rij["klantPromo"];

            $sql = "UPDATE klanten SET klantPromo = :klantPromo 
            WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            if ($klantPromo === 1) {
                $stmt->execute(
                    array(
                        ':klantId' => $klantId,
                        ':klantPromo' => 0
                    )
                );
            } else {
                $stmt->execute(
                    array(
                        ':klantId' => $klantId,
                        ':klantPromo' => 1
                    )
                );
            }
            $klant = $this->getKlantByKlantId($klantId);
            $dbh = null;
            return $klant;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        } 
    }
}
