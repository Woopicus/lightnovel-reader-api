<?php

namespace App\Controller;

use App\Service\LightnovelService;
use App\Service\SeriesService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class LightnovelController extends AbstractController
{
    #[Route('/lightnovel', name: 'app_lightnovel')]
    public function LN(LightnovelService $service): Response
    {
       return new JsonResponse(
           [
               'ln'=> ['text, chapters, books', $service->doSomething()],
               $service->doSomething(),
               'Light'=> $service->doSomething()
           ]
        );
    }

    #[Route('api/books', methods:['POST'])]
    public function reading(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'lightnovel'=> ['name','text','numbers',],
                $request->getPayload()->all(),
            ]
        );
    }
}

//#[Route('/lightnovel', name: 'app_lightnovel')]
//    public function LN(LightnovelService $service): Response
//    {
//        return $this->render('lightnovel/index.html.twig', [
//            'controller_name' => 'LightnovelController',
//        ]);
//    }//