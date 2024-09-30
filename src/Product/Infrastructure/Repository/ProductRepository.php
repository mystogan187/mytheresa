<?php

namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
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

        foreach ($data['products'] as $item) {
            $this->products[] = new Product(
                $item['sku'],
                $item['name'],
                $item['category'],
                $item['price']
            );
        }
    }

    public function findAll(): array
    {
        return $this->products;
    }

    public function findByCategory(string $category): array
    {
        return array_filter($this->products, fn($product) => $product->getCategory() === $category);
    }

    public function findByPriceLessThan(float $price): array
    {
        return array_filter($this->products, fn($product) => $product->getPrice() <= $price);
    }
}