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

}