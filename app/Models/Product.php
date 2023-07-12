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
        $query = "SELECT product.id, product.product, product.price, product.product_type_id, product_type.tax, product_type.description  FROM product 
        INNER JOIN product_type ON product_type.id = product.product_type_id";
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        } catch (\PDOException $e) {
            return [
                "status" => false,
                "msg" => $e->getMessage()
            ];
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
                "msg" => "Product type created successfully"
            ];
        }
        
        throw new \Exception("Error Processing Request", 1);
    }

    public function edit(int $id, array $data): array
    {
        $this->validateColumns($data);

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