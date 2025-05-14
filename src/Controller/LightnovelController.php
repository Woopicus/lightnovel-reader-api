<?php

namespace App\Controller;

use App\Service\LightnovelService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class LightnovelController extends AbstractController
{
    public function __construct(
        private readonly LightnovelService $lightnovelService
    ) {}

    #[Route('api/lightnovels', methods:['GET'])]
    public function getLightnovels(): JsonResponse
    {
       $lightnovels = $this->lightnovelService->getLightnovels();

       return $this->json([
            'data' => $lightnovels
       ]);
    }

    #[Route('api/lightnovels/{lightnovelId}', methods:['GET'])]
    public function getLightnovel(int $lightnovelId): JsonResponse
    {
       $lightnovel = $this->lightnovelService->getLightnovel($lightnovelId);

       return $this->json([
            'data' => $lightnovel
       ]);
    }

    #[Route('api/lightnovels', methods:['POST'])]
    public function createLightnovel(Request $request): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $price = $request->getPayload()->get('price');
        $description = $request->getPayload()->get('description');

        $lightnovel = $this->lightnovelService->createLightnovel($name, $price, $description);

        return $this->json([
            'data' => $lightnovel
        ]);
    }

    #[Route('api/lightnovels/{lightnovelId}', methods:['PUT'])]
    public function updateLightnovel(Request $request, int $lightnovelId): JsonResponse
    {
        $name = $request->getPayload()->get('name');
        $price = $request->getPayload()->get('price');
        $description = $request->getPayload()->get('description');

        $lightnovel = $this->lightnovelService->updateLightnovel($lightnovelId, $name, $price, $description);

        return $this->json([
            'data' => $lightnovel
        ]);
    }

    #[Route('api/lightnovels/{lightnovelId}', methods:['DELETE'])]
    public function removeLightnovel(int $lightnovelId): JsonResponse
    {
        $this->lightnovelService->removeLightnovel($lightnovelId);

        return $this->json(null);
    }
}