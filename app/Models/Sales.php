<?php

namespace App\Models;

class Sales extends Model
{
    private const TABLE = 'sales';
    protected function getTable(): string
    {
        return self::TABLE;
    }

}