<?php

declare(strict_types=1);


namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {}

    #[Route('api/categories', methods:['GET'])]
    public function getCategories(): JsonResponse
    {
       $categories = $this->categoryService->getCategories();

       return $this->json([
            'data' => $categories
       ]);
    }

    #[Route('api/categories/{categoryId}', methods:['GET'])]
    public function getCategory(int $categoryId): JsonResponse
    {
       $category = $this->categoryService->getcategory($categoryId);

       return $this->json([
            'data' => $category
       ]);
    }

    #[Route('api/categories', methods:['POST'])]
    public function createCategory(Request $request): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $description = $request->getPayload()->get('description');

        $category = $this->categoryService->createcategory($name, $description);

        return $this->json([
            'data' => $category
        ]);
    }

    #[Route('api/categories/{categoryId}', methods:['PUT'])]
    public function updateCategory(Request $request, int $categoryId): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $description = $request->getPayload()->get('description');

        $category = $this->categoryService->updateCategory($categoryId, $name, $description);

        return $this->json([
            'data' => $category
        ]);
    }

    #[Route('api/categories/{categoryId}', methods:['DELETE'])]
    public function removeCategory(int $categoryId): JsonResponse
    {
        $this->categoryService->removecategory($categoryId);

        return $this->json(null);
    }
}
