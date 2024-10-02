<?php

namespace App\LinkedinPosts\Infrastructure\Controller;

use App\LinkedinPosts\Application\UseCase\GetLinkedinPostsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JobPostsController extends AbstractController
{
    private GetLinkedinPostsUseCase $useCase;

    public function __construct(GetLinkedinPostsUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(Request $request): JsonResponse{

        $posts = $this->useCase->execute();

        return $this->json(['posts' => $posts]);
    }
}