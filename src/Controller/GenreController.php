<?php

namespace App\Controller;

use App\Service\GenreService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GenreController extends AbstractController
{
    public function __construct(
        private readonly genreService $genreService
    ) {}

    #[Route('api/genres', methods:['GET'])]
    public function getGenres(): JsonResponse
    {
       $genres = $this->genreService->getGenres();

       return $this->json([
            'data' => $genres
       ]);
    }

    #[Route('api/genres/{genreId}', methods:['GET'])]
    public function getGenre(int $genreId): JsonResponse
    {
       $genre = $this->genreService->getGenre($genreId);

       return $this->json([
            'data' => $genre
       ]);
    }

    #[Route('api/genres', methods:['POST'])]
    public function createGenre(Request $request): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $category = $request->getPayload()->get('category');
        $description = $request->getPayload()->get('description');

        $genre = $this->genreService->createGenre($name, $category, $description);

        return $this->json([
            'data' => $genre
        ]);
    }

    #[Route('api/genres/{genreId}', methods:['PUT'])]
    public function updateGenre(Request $request, int $genreId): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $category = $request->getPayload()->get('category');
        $description = $request->getPayload()->get('description');

        $genre = $this->genreService->updateGenre($genreId, $name, $category, $description);

        return $this->json([
            'data' => $genre
        ]);
    }

    #[Route('api/genres/{genreId}', methods:['DELETE'])]
    public function removeGenre(int $genreId): JsonResponse
    {
        $this->genreService->removeGenre($genreId);

        return $this->json(null);
    }
}