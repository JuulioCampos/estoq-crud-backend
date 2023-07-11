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

}