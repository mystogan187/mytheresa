<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProductService;

class ProductController
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    /**
     * @Route("/products", methods={"GET"})
     */
    public function getProducts(Request $request): JsonResponse
    {
        $category = $request->query->get('category');
        $priceLessThan = $request->query->get('priceLessThan');

        $priceLessThan = $priceLessThan !== null ? (int) $priceLessThan : null;

        $products = $this->productService->getProducts($category, $priceLessThan);

        return new JsonResponse(['products' => array_values($products)]);
    }
}