<?php

namespace App\Models;

class Product extends Model
{
    private const TABLE = 'product';
    protected function getTable(): string
    {
        return self::TABLE;
    }

}