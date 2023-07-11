<?php

namespace App\Database;

class Connection
{
    private static $instance;

    private function __construct() {}

    public static function getConnection()
    {
        $host = getenv("POSTGRES_HOST");
        $db= getenv("POSTGRES_DB");
        $user= getenv("POSTGRES_USER");
        $pass = getenv("POSTGRES_PASSWORD");
        $port= getenv("POSTGRES_PORT");
        if (!isset(self::$instance)) {
            $dsn = "pgsql:host={$host};port={$port};dbname={$db}";
            $username = $user;
            $password = $pass;

            try {
                self::$instance = new \PDO($dsn, $username, $password);
            } catch (\PDOException $e) {
                die('Error connecting to the database: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
