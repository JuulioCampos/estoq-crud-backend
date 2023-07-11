<?php

namespace App\Models;

use App\Database\Connection;

class Model
{
    private $db;
    public function __construct()
    {
        $this->db = Connection::getConnection();
    }

    public function findById(int $id): ?array
    {
        $query = "SELECT * FROM {$this->getTable()} WHERE id = :id";
        $stmt = (Connection::getConnection())->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        try {
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (\PDOException $e) {
            die('Error executing query: ' . $e->getMessage());
        }
    }
    public function getAll(): array
    {
        $query = "SELECT * FROM {$this->getTable()}";
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        } catch (\PDOException $e) {
            die('Error executing query: ' . $e->getMessage());
        }
    }

    public function findWhere(array $conditions): array
    {
        $table = $this->getTable();
        $query = "SELECT * FROM $table";
        $where = "";

        if (!empty($conditions)) {
            $where = " WHERE ";
            $conditionsArr = [];

            foreach ($conditions as $column => $value) {
                $conditionsArr[] = "$column = :$column";
            }

            $where .= implode(" AND ", $conditionsArr);
        }

        $query .= $where;
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute($conditions);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        } catch (\PDOException $e) {
            die('Error executing query: ' . $e->getMessage());
        }
    }

    protected function getTable(): ?string
    {
    }

}