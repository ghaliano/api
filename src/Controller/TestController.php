<?php

namespace App\Controller;

use App\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    /**
     * @Route("/test/api/places/{id}", name="api_places_item")
     */
    public function item($id): Response
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($id);

        return new JsonResponse($place);
    }

    /**
     * @Route("/test/api/places", name="api_places")
     */
    public function list(): Response
    {
        $places = $this->getDoctrine()->getRepository(Place::class)->findAll();

        return new JsonResponse($places);
    }
}
