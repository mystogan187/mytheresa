<?php

namespace App\Product\Application\UseCase;

use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Domain\Service\ProductDiscountService;

class GetProductsUseCase
{
    private ProductRepositoryInterface $productRepository;
    private ProductDiscountService $discountService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductDiscountService $discountService
    ) {
        $this->productRepository = $productRepository;
        $this->discountService = $discountService;
    }

    public function execute(?string $category, ?float $priceLessThan): array
    {
        $products = $this->productRepository->findAll();

        if ($category !== null) {
            $products = $this->productRepository->findByCategory($category);
        }

        if ($priceLessThan !== null) {
            $products = array_filter($products, fn($product) => $product->getPrice() <= $priceLessThan);
        }

        $products = array_map([$this->discountService, 'applyDiscount'], $products);

        return $products;
    }
}
