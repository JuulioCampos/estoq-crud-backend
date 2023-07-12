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

    public function create(array $data): array
    {
        foreach ($this->requiredColumns as $column) {
            if (!array_key_exists($column, $data)) {
                throw new \InvalidArgumentException("Missing required column: $column");
            }
        }
        if ($this->insert($data)) {
            return [
                "status" => true,
                "msg" => "Product created successfully"
            ];
        }
        throw new \Exception("Error Processing Request", 1);
    }

    public function edit(int $id, array $data): array
    {
        foreach ($this->requiredColumns as $column) {
            if (!array_key_exists($column, $data)) {
                throw new \InvalidArgumentException("Missing required column: $column");
            }
        }
        if ($this->update($id, $data)) {
            return [
                "status" => true,
                "msg" => "Product updated successfully"
            ];
        }
        throw new \Exception("Error Processing Request", 1);
        
    }

    public function delete(int $id): array
    {
        if ($this->remove($id)) {
            return [
                "status" => true,
                "msg" => "Product deleted successfully"
            ];
        }
        throw new \Exception("Error Processing Request", 1);
    }
}