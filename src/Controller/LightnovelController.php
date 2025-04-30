<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\LightnovelService;

class LightnovelController extends AbstractController
{
    #[Route('/lightnovel', name: 'app_lightnovel')]
    public function LN(LightnovelService $service): Response
    {
        return $this->render('lightnovel/index.html.twig', [
            'controller_name' => 'LightnovelController',
        ]);
    }

    #[Route('api/books')]
    public function reading(): JsonResponse
    {
        return new JsonResponse(
        [
            'lightnovel'=> ['name','text','numbers',]
            ]
        );
    }
}
