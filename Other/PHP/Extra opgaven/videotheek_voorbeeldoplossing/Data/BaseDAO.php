<?php

declare(strict_types=1);

namespace Data;

use Data\DBConfig;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/DBConfig.php";
*/

/**
 * A Base class where other DAO classes can inherit from.
 * Every code related to DB connection that can be reused 
 * in other DAO classes should be written here.
 */
class BaseDAO
{
    /**
     * A function to connect to the DB. 
     * @return PDO - A pdo object if the connection was successful
     */
    protected function db_connect(): ?\PDO
    {
        try {
            $dbh =  new \PDO(
                \DBConfig::$DB_CONNSTRING,
                \DBConfig::$DB_USER,
                \DBConfig::$DB_PASSWORD
            );
            // tells PDO to disable emulated prepared statements and use real prepared statements. 
            // This makes sure the statement and the values aren't parsed by PHP before sending it to the MySQL server 
            // (giving a possible attacker no chance to inject malicious SQL). 
            //See: https://stackoverflow.com/a/60496 
            $dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

            //This way the script will not stop with a Fatal Error when something goes wrong
            //It gives the developer the chance to catch any error(s) which are thrown as PDOExceptions.
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $dbh;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return null;
    }
}
