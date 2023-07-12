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
                "msg" => "Sales updated successfully"
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