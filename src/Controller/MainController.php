<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        //test
        $navItems = [
            [
                "label" => "Présentation",
                "url" => "#part1"
            ],
            [
                "label" => "Dispositif E2C",
                "url" => "#part2"
            ],
            [
                "label" => "Infos pratiques",
                "url" => "#part3"
            ],
            [
                "label" => "Participer à une RIC",
                "url" => $this->generateUrl('app_ric')
            ],
        ];

        return $this->render('main/index.html.twig', [
            'navItems' => $navItems,
        ]);
    }
}
