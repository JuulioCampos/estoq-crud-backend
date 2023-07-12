<?php

namespace App\Models;

class ProductType extends Model
{
    private const TABLE = 'product_type';
    protected $requiredColumns = ['description', 'tax'];

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
                "msg" => "Product type updated successfully"
            ];
        }

        throw new \Exception("Error Processing Request", 1);
    }

    public function delete(int $id): array
    {
        if ($this->remove($id)) {
            return [
                "status" => true,
                "msg" => "Product type deleted successfully"
            ];
        }
        throw new \Exception("Error Processing Request", 1);
    }
}