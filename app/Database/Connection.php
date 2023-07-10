<?php

namespace App\Database;

class Connection
{
    private static $instance;

    private function __construct() {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $dsn = 'pgsql:host=localhost;dbname=teste';
            $username = 'root';
            $password = 'root';

            try {
                self::$instance = new \PDO($dsn, $username, $password);
            } catch (\PDOException $e) {
                die('Error connecting to the database: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
