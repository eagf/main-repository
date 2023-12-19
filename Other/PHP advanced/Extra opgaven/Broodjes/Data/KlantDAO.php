<?php
//Data/KlantDAO 
declare(strict_types=1);

namespace Data;

use Data\BaseDAO;

use Exceptions\KlantBestaatAlException;
use Exceptions\KlantBestaatNietException;
use Exceptions\OngeldigEmailadresException;
use Exceptions\WachtwoordenKomenNietOvereenException;
use Exceptions\WachtwoordIncorrectException;

use Entities\Klant;

class KlantDAO extends BaseDAO
{
    public function registreer($naam, $voornaam, $email, $wachtwoord)
    {
        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new OngeldigEmailadresException();
            }
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");

            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $resultSet = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($resultSet) {
                throw new KlantBestaatAlException();
            }

            $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $stmt = $dbh->prepare("INSERT INTO klanten (naam, voornaam, email, wachtwoord) VALUES (:naam, :voornaam, :email, :wachtwoord)");
            $stmt->bindValue(":naam", $naam);
            $stmt->bindValue(":voornaam", $voornaam);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":wachtwoord", $wachtwoord);
            $stmt->execute();

            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function login(string $email, string $wachtwoord): ?Klant
    {
        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new OngeldigEmailadresException();
            }
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $resultSet = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$resultSet) {
                throw new KlantBestaatNietException();
            }

            $isWachtwoordCorrect = password_verify($wachtwoord, $resultSet["wachtwoord"]);

            if (!$isWachtwoordCorrect) {
                throw new WachtwoordIncorrectException();
            }

            $klant = new Klant(
                (int) $resultSet["klantid"],
                $resultSet["naam"],
                $resultSet["voornaam"],
                $resultSet["email"],
                $resultSet["wachtwoord"]
            );
            $dbh = null;
            return $klant;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }

    public function updateWachtwoord($email, $wachtwoord)
    { {
            try {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new OngeldigEmailadresException();
                }
                
                $dbh = $this->db_connect();
                $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");

                $stmt->bindValue(":email", $email);
                $stmt->execute();
                $resultSet = $stmt->fetch(\PDO::FETCH_ASSOC);

                if (!$resultSet) {
                    throw new KlantBestaatNietException();
                }

                $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

                $stmt = $dbh->prepare("UPDATE klanten SET wachtwoord = :wachtwoord where email = :email");
                $stmt->bindValue(":email", $email);
                $stmt->bindValue(":wachtwoord", $wachtwoord);
                $stmt->execute();

                $dbh = null;
            } catch (\PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
            }
        }
    }
}