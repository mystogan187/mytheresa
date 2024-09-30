<?php

namespace App\Product\Domain\Repository;

interface ProductRepositoryInterface
{
    public function findAll(): array;
    public function findByCategory(string $category): array;
    public function findByPriceLessThan(float $price): array;
}