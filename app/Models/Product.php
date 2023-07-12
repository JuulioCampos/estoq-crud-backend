<?php

namespace App\Models;

class Product extends Model
{
    private const TABLE = 'product';
    protected $requiredColumns = ['product', 'price', 'product_type_id'];
    protected function getTable(): string
    {
        return self::TABLE;
    }
    public function getAll(): array
    {
        $query = "SELECT * FROM product 
        INNER JOIN product_type ON product_type.id = product.id";
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        } catch (\PDOException $e) {
            die('Error executing query: ' . $e->getMessage());
        }
    }

    public function create(array $data): bool
    {
        foreach ($this->requiredColumns as $column) {
            if (!array_key_exists($column, $data)) {
                throw new \InvalidArgumentException("Missing required column: $column");
            }
        }

        return $this->insert($data);
    }

    public function edit(int $id, array $data): bool
    {
        foreach ($this->requiredColumns as $column) {
            if (!array_key_exists($column, $data)) {
                throw new \InvalidArgumentException("Missing required column: $column");
            }
        }

        return $this->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->delete($id);
    }
}