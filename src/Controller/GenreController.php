<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Genre;

class GenreController extends AbstractController
{
    #[Route('api/genres', methods:['GET'])]
    public function getGenres(EntityManagerInterface $entityManager): JsonResponse
    {
       $genreRepository = $entityManager->getRepository(Genre::class);
       $genres = $genreRepository->findAll();

       return $this->json([
            'data' => $genres
       ]);
    }

    #[Route('api/genres/{genreId}', methods:['GET'])]
    public function getGenre(int $genreId, EntityManagerInterface $entityManager): JsonResponse
    {
       $genreRepository = $entityManager->getRepository(Genre::class);
       $genre = $genreRepository->find($genreId);

       return $this->json([
            'data' => $genre
       ]);
    }

    #[Route('api/genres', methods:['POST'])]
    public function createGenre(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $category = $request->getPayload()->get('category');
        $description = $request->getPayload()->get('description');

        $genre = new Genre();
        $genre->setName($name);
        $genre->setCategory($category);
        $genre->setDescription($description);

        $entityManager->persist($genre);
        $entityManager->flush();

        return $this->json([
            'data' => $genre
        ]);
    }

    #[Route('api/genres/{genreId}', methods:['PUT'])]
    public function updateGenre(Request $request, EntityManagerInterface $entityManager, int $genreId): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $category = $request->getPayload()->get('category');
        $description = $request->getPayload()->get('description');

        $genreRepository = $entityManager->getRepository(Genre::class);
        $genre = $genreRepository->find($genreId);
        $genre->setName($name);
        $genre->setCategory($category);
        $genre->setDescription($description);

        $entityManager->persist($genre);
        $entityManager->flush();

        return $this->json([
            'data' => $genre
        ]);
    }

    #[Route('api/genres/{genreId}', methods:['DELETE'])]
    public function removeGenre(EntityManagerInterface $entityManager, int $genreId): JsonResponse
    {
        $genreRepository = $entityManager->getRepository(Genre::class);
        $genre = $genreRepository->find($genreId);

        $entityManager->remove($genre);
        $entityManager->flush();

        return $this->json(null);
    }
}