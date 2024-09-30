<?php

namespace App\Product\Infrastructure\Controller;


use App\Product\Application\UseCase\GetProductsUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class ProductController extends AbstractController
{
    private GetProductsUseCase $getProductsUseCase;

    public function __construct(GetProductsUseCase $getProductsUseCase)
    {
        $this->getProductsUseCase = $getProductsUseCase;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $category = $request->query->get('category');
        $priceLessThan = $request->query->get('priceLessThan');

        $priceLessThan = $priceLessThan !== null ? (float) $priceLessThan : null;

        $products = $this->getProductsUseCase->execute($category, $priceLessThan);

        return $this->json(['products' => $products]);
    }
}
