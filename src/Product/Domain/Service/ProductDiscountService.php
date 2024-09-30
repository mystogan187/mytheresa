<?php

namespace App\Product\Domain\Service;

use App\Product\Domain\Entity\Product;

class ProductDiscountService
{
    public function applyDiscount(Product $product): Product
    {
        $discounts = [];

        if ($product->getCategory() === 'boots') {
            $discounts[] = 30;
        }

        if ($product->getSku() === '000003') {
            $discounts[] = 15;
        }

        $maxDiscount = $discounts ? max($discounts) : 0;
        $originalPrice = $product->getPrice();
        $finalPrice = $originalPrice - ($originalPrice * ($maxDiscount / 100));

        $product->setPrice($finalPrice);

        return $product;
    }
}
