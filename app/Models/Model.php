<?php

namespace App\Models;
use App\Database\Connection;
class Model
{ 
    private $db;
    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function findById(int $id): ?array
    {
        $query = "SELECT * FROM product_type WHERE id = :id";
        $stmt = (Connection::getConnection())->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        print_r($result);
        die;
        try {
            return $result ?: null;
        } catch (\PDOException $e) {
            die('Error executing query: ' . $e->getMessage());
        }
    }

    protected function getTable():string {}
 
}
