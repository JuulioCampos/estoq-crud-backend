<?php

namespace App\Models;

class Sales extends Model
{
    private const TABLE = 'sales';
    protected $requiredColumns = ["product_id", "amount",];

    protected function getTable(): string
    {
        return self::TABLE;
    }
    public function getAll(): array
    {
        $query = "SELECT * FROM sales 
        INNER JOIN product ON product.id = sales.product_id";
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
                "msg" => "Sale created successfully"
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
                "msg" => "Sale updated successfully"
            ];
        }

        throw new \Exception("Error Processing Request", 1);
    }

    public function delete(int $id): array
    {
        if ($this->remove($id)) {
            return [
                "status" => true,
                "msg" => "Sales deleted successfully"
            ];
        }
        throw new \Exception("Error Processing Request", 1);
    }
}