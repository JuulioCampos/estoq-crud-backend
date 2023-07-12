<?php

use PHPUnit\Framework\TestCase;
use App\Models\ProductType;

class ProductTypeTest extends TestCase
{
    private $productTypeId;

    protected function setUp(): void
    {
        // Executado antes de cada teste
        $this->productTypeId = 1;
    }

    public function testFindExistingProductType()
    {
        $productType = new ProductType();
        $result = $productType->findById($this->productTypeId);

        $this->assertNotNull($result);
        $this->assertEquals($this->productTypeId, $result['id']);
    }

    public function testCreateProductType()
    {
        $productTypeData = [
            'description' => 'Teste-' . md5(time() . rand(0, 9999) . time()),
            'tax' => 10.0
        ];

        $productType = new ProductType();
        $result = $productType->create($productTypeData);

        $this->assertTrue($result['status']);
    }

    public function testEditProductType()
    {
        $productTypeData = [
            'description' => 'Updated Product Type'
        ];

        $productType = new ProductType();
        $result = $productType->edit($this->productTypeId, $productTypeData);

        $this->assertTrue($result['status']);

        // Verificar se o tipo de produto foi editado corretamente
        $editedProductType = $productType->findById($this->productTypeId);
        $this->assertEquals($productTypeData['description'], $editedProductType['description']);
    }
}
