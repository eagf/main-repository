<?php

declare(strict_types=1);

namespace Data;

use Data\BaseDAO;
use Entities\User;
use Exceptions\InvalidPasswordException;
use Exceptions\UserNotFoundException;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/BaseDAO.php";
require_once __DIR__ . "/../Entities/User.php";
require_once __DIR__ . "/../Exceptions/InvalidPasswordException.php";
require_once __DIR__ . "/../Exceptions/UserNotFoundException.php";
*/

class UserDAO extends BaseDAO
{
    /**
     * returns an object of user from the DB, if it exists and the password is correct.
     */
    public function loginUser(string $username, string $password): ?User
    {
        try {
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");

            $stmt->bindValue(":username", $username);
            $stmt->execute();
            $resultSet = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$resultSet) {
                throw new UserNotFoundException();
            }

            $isWachtwoordCorrect = password_verify($password, $resultSet["password"]);

            if (!$isWachtwoordCorrect) {
                throw new InvalidPasswordException();
            }

            $user = new User(
                (int)$resultSet["id"],
                $resultSet["username"],
                $resultSet["password"]
            );
            $dbh = null;

            return $user;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }
}
