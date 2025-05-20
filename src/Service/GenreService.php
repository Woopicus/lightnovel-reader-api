<?php

namespace App\Service;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class GenreService
{
    public function __construct(
       private EntityManagerInterface $entityManager,
       private GenreRepository $genreRepository,
    ) {}

    public function getGenres(): array
    {
       return $this->genreRepository->findAll();
    }

   public function getGenre(int $genreId): ?Genre
    {
       return $this->genreRepository->find($genreId);
    }

    public function createGenre(string $name, string $category, string $description): Genre
    {
        $genre = new Genre();
        $genre->setName($name);
        $genre->setCategory($category);
        $genre->setDescription($description);

        $this->entityManager->persist($genre);
        $this->entityManager->flush();

        return $genre;
    }

    public function updateGenre(int $genre, string $name, string $category, string $description): ?Genre
    {
        $genre = $this->getGenre($genre);

        if  ($genre) {
            $genre->setName($name);
            $genre->setCategory($category);
            $genre->setDescription($description);

            $this->entityManager->persist($genre);
            $this->entityManager->flush();
        }

        return $genre;
    }

    public function removeGenre(int $genreId): void
    {
        $genre = $this->getGenre($genreId);

        if ($genre) {
            $this->entityManager->remove($genre);
            $this->entityManager->flush();
        }
    }
}