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

}