<?php

use PHPUnit\Framework\TestCase;
use App\Models\Sales;

class SalesTest extends TestCase
{
    public function testFindExistingSale()
    {
        $saleId = 1;
        $sale = new Sales();
        $result = $sale->findById($saleId);

        $this->assertNotNull($result);
        $this->assertEquals($saleId, $result['id']);
    }

    public function testCreateSale()
    {
        $saleData = [
            'product_id' => 2,
            'amount' => 10.0
        ];

        $sale = new Sales();
        $result = $sale->create($saleData);

        $this->assertTrue($result['status']);
    }
}
