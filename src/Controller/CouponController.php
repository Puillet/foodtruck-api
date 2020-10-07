<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Coupon;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CouponController extends AbstractController
{
    /**
     * @Route("/coupon", name="coupon", methods="GET")
     */
    public function getCoupons(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Coupon::class);
        $coupons = $repository->findAll();
        $formatted = [];
        foreach ($coupons as $coupon){
            $formatted[] = [
                'id' => $coupon->getId(),
                'code' => $coupon->getCode(),
                'description' => $coupon->getDescription(),
            ];
        }

        $response = new Response();
        $response->setContent(json_encode($formatted));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/coupon/{id}", name="coupon_one", methods="GET")
     */
    public function getCoupon(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Coupon::class);
        $coupon = $repository->find($request->get('id'));
        $formatted = [
            'id' => $coupon->getId(),
            'code' => $coupon->getCode(),
            'description' => $coupon->getDescription(),
        ];

        $response = new Response();
        $response->setContent(json_encode($formatted));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
