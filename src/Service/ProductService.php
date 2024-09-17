<?php

namespace App\Service;

use App\Entity\Product;

class ProductService
{
    private array $products;

    public function __construct()
    {
        $this->loadProducts();
    }

    private function loadProducts(): void
    {
        $json = file_get_contents(__DIR__ . '/../Data/products.json');
        $data = json_decode($json, true);
        $this->products = $data['products'];
    }

    public function getProducts(?string $category, ?int $priceLessThan): array
    {
        $products = $this->products;

        if ($priceLessThan !== null) {
            $products = array_filter($products, fn($product) => $product['price'] <= $priceLessThan);
        }

        if ($category !== null) {
            $products = array_filter($products, fn($product) => $product['category'] === $category);
        }

        $products = array_map([$this, 'applyDiscount'], $products);

        return array_slice($products, 0, 5);
    }

    private function applyDiscount(array $product): array
    {
        $discounts = [];

        if ($product['category'] === 'boots') {
            $discounts[] = 30;
        }

        if ($product['sku'] === '000003') {
            $discounts[] = 15;
        }

        $maxDiscount = $discounts ? max($discounts) : 0;
        $originalPrice = $product['price'];
        $finalPrice = $originalPrice - ($originalPrice * ($maxDiscount / 100));

        $product['price'] = [
            'original' => $originalPrice,
            'final' => (int) $finalPrice,
            'discount_percentage' => $maxDiscount > 0 ? "{$maxDiscount}%" : null,
            'currency' => 'EUR',
        ];

        return $product;
    }
}