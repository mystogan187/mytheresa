<?php

namespace App\API;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Product\Infrastructure\Controller\ProductController;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/products',
            controller: ProductController::class,
            openapiContext: [
                'summary' => 'Obtiene una colección de productos',
                'parameters' => [
                    [
                        'name' => 'category',
                        'in' => 'query',
                        'required' => false,
                        'schema' => ['type' => 'string'],
                        'description' => 'Filtrar por categoría'
                    ],
                    [
                        'name' => 'priceLessThan',
                        'in' => 'query',
                        'required' => false,
                        'schema' => ['type' => 'number'],
                        'description' => 'Filtrar productos con precio menor al valor especificado'
                    ]
                ]
            ],
            normalizationContext: ['groups' => ['product:read']],
            read: false,
            name: 'get_products'
        )
    ],
    normalizationContext: ['groups' => ['product:read']],
    paginationEnabled: false
)]
class ProductApiResource
{
    #[Groups(['product:read'])]
    public string $sku;

    #[Groups(['product:read'])]
    public string $name;

    #[Groups(['product:read'])]
    public string $category;

    #[Groups(['product:read'])]
    public float $price;
}