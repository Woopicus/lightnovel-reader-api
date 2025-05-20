<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class CategoryService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private CategoryRepository     $categoryRepository,
    ) {}

    public function getCategories(): array
    {
        return $this->categoryRepository->findAll();
    }

    public function getCategory(int $categoryId): ?Category
    {
        return $this->categoryRepository->find($categoryId);
    }

    public function createCategory(string $name, string $description): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setDescription($description);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

    public function updateCategory(int $category, string $name, string $description): ?Category
    {
        $category = $this->getCategory($category);

        if ($category) {
            $category->setName($name);
            $category->setDescription($description);

            $this->entityManager->persist($category);
            $this->entityManager->flush();
        }

        return $category;
    }

    public function removeCategory(int $categoryId): void
    {
        $category = $this->getCategory($categoryId);

        if ($category) {
            $this->entityManager->remove($category);
            $this->entityManager->flush();
        }
    }
}