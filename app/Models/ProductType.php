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