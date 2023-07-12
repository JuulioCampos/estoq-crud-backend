<?php

use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    public function testFindExistingProduct()
    {
        $productId = 1;
        $product = new Product();
        $result = $product->findById($productId);

        $this->assertNotNull($result);
    }

    public function testGetAllProducts()
    {
        $product = new Product();
        $result = $product->getAll();

        $this->assertIsArray($result);
    }

    public function testCreateProduct()
    {
        $productData = [
            'product' => 'New Product',
            'price' => 9.99,
            'product_type_id' => 1
        ];

        $product = new Product();
        $result = $product->create($productData);

        $this->assertTrue($result['status']);
    }

    public function testEditProduct()
    {
        $productId = 5;
        $newProductName = 'Updated Product';

        $productData = [
            'product' => $newProductName
        ];

        $product = new Product();
        $result = $product->edit($productId, $productData);

        $this->assertTrue($result['status']);
    }
}
