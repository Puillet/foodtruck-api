<?php

namespace App\Controller;

use App\Entity\Truck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TruckController extends AbstractController
{
    /**
     * @Route("/truck", name="truck")
     */
    public function getCoupons(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Truck::class);
        $trucks = $repository->findAll();
        $formatted = [];
        foreach ($trucks as $truck){
            $formatted[] = [
                'id' => $truck->getId(),
                'nom' => $truck->getNom(),
                'positionX' => $truck->getPositionX(),
                'positionY' => $truck->getPositionY(),
            ];
        }

        $response = new Response();
        $response->setContent(json_encode($formatted));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
