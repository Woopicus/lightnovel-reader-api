<?php

declare(strict_types=1);


namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class ProjectService
{
    public function __construct(
       private EntityManagerInterface $entityManager,
       private ProjectRepository $projectRepository,
    ) {}

    public function getProjects(): array
    {
       return $this->projectRepository->findAll();
    }

   public function getProject(int $projectId): ?Project
    {
       return $this->projectRepository->find($projectId);
    }

    public function createProject(string $name, string $category, string $description): Project
    {
        $project = new Project();
        $project->setName($name);
        $project->setCategory($category);
        $project->setDescription($description);

        $this->entityManager->persist($project);
        $this->entityManager->flush();

        return $project;
    }

    public function updateProject(int $projectId, string $name, string $category, string $description): ?Project
    {
        $project = $this->getProject($projectId);

        if  ($project) {
            $project->setName($name);
            $project->setCategory($category);
            $project->setDescription($description);

            $this->entityManager->persist($project);
            $this->entityManager->flush();
        }

        return $project;
    }

    public function removeProject(int $projectId): void
    {
        $project = $this->getProject($projectId);

        if ($project) {
            $this->entityManager->remove($project);
            $this->entityManager->flush();
        }
    }
}
