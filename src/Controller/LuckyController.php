<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

const NUMBER_TEMPLATE = 'lucky/number.html.twig';

class LuckyController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     * @Route("/lucky/number")
     */
    public function number() {
        $number = random_int(0,100);

        return $this->render(NUMBER_TEMPLATE, [
            'number' => $number
        ]);
    }

}