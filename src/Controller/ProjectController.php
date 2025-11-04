<?php

declare(strict_types=1);


namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService
    ) {}

    #[Route('api/projects', methods:['GET'])]
    public function getProjects(): JsonResponse
    {
       $projects = $this->projectService->getProjects();

       return $this->json([
            'data' => $projects
       ]);
    }

    #[Route('api/projects/{projectId}', methods:['GET'])]
    public function getProject(int $projectId): JsonResponse
    {
       $project = $this->projectService->getProject($projectId);

       return $this->json([
            'data' => $project
       ]);
    }

    #[Route('api/projects', methods:['POST'])]
    public function createProject(Request $request): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $category = $request->getPayload()->get('category');
        $description = $request->getPayload()->get('description');

        $project = $this->projectService->createProject($name, $category, $description);

        return $this->json([
            'data' => $project
        ]);
    }

    #[Route('api/projects/{projectId}', methods:['PUT'])]
    public function updateProject(Request $request, int $projectId): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $category = $request->getPayload()->get('category');
        $description = $request->getPayload()->get('description');

        $project = $this->projectService->updateProject($projectId, $name, $category, $description);

        return $this->json([
            'data' => $project
        ]);
    }

    #[Route('api/projects/{projectId}', methods:['DELETE'])]
    public function removeProject(int $projectId): JsonResponse
    {
        $this->projectService->removeProject($projectId);

        return $this->json(null);
    }
}
