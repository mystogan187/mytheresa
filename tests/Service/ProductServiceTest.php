<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ProductService;

class ProductServiceTest extends TestCase
{
    public function testGetProductsReturnsMaximumFiveProducts()
    {
        $service = new ProductService();
        $products = $service->getProducts(null, null);

        $this->assertLessThanOrEqual(5, count($products));
    }

    public function testDiscountsAppliedCorrectly()
    {
        $service = new ProductService();
        $products = $service->getProducts(null, null);

        foreach ($products as $product) {
            if ($product['sku'] === '000001' || $product['sku'] === '000002') {
                $this->assertEquals('30%', $product['price']['discount_percentage']);
            } elseif ($product['sku'] === '000003') {
                $this->assertEquals('30%', $product['price']['discount_percentage']); // 30% over 15%
            } else {
                $this->assertNull($product['price']['discount_percentage']);
            }
        }
    }

}
