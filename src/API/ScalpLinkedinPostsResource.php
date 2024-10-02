<?php

namespace App\API;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\LinkedinPosts\Infrastructure\Controller\JobPostsController;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/get_posts',
            controller: JobPostsController::class,
            normalizationContext: ['groups' => ['posts:read']],
            read: false,
            name: 'get_posts'
        )
    ],
    normalizationContext: ['groups' => ['posts:read']],
    paginationEnabled: false
)]

class ScalpLinkedinPostsResource
{

}