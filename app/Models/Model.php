<?php

namespace App\Models;

use App\Database\Connection;

class Model
{
    public $db;
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
            return false;
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

    public function findWhere(array $conditions): array|bool
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
            return false;
        }
    }

    public function insert(array $data): bool|array
    {
        $table = $this->getTable();
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = $this->db->prepare($query);
        try {
            $stmt->execute($data);
            return true;
        } catch (\PDOException $e) {
            die('Error executing query: ' . $e->getMessage());
        }
    }

    public function update(int $id, array $data): bool|array
    {
        $table = $this->getTable();
        $columns = array_keys($data);
        $validColumns = array_intersect($columns, $this->requiredColumns);

        if (empty($validColumns)) {
            throw new \InvalidArgumentException('No valid columns provided for update');
        }

        $set = implode(', ', array_map(function ($column) {
            return "$column = :$column";
        }, $validColumns));

        $query = "UPDATE $table SET $set WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $data['id'] = $id;

        try {
            $stmt->execute($data);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function remove(int $id): bool|array
    {
        $table = $this->getTable();
        $query = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    protected function getTable(): ?string
    {
    }

    public function validateColumns(array $data): void
    {
        $columns = array_keys($data);
        $invalidColumns = array_diff($columns, $this->requiredColumns);

        if (!empty($invalidColumns)) {
            $invalidColumnsStr = implode(', ', $invalidColumns);
            throw new \InvalidArgumentException("Invalid columns provided for update: $invalidColumnsStr");
        }
    }
}