<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PnumProgramController extends AbstractController
{
    #[Route('/programme', name: 'app_program')]
    public function index(): Response
    {
        $navItems = [
            [
                "label" => "Ateliers",
                "url" => "#part2"
            ],
            [
                "label" => "Activités transversales",
                "url" => "#part3"
            ],
            [
                "label" => "Workshop",
                "url" => "#part1"
            ],
            [
                "label" => "Participer à une RIC",
                "url" => $this->generateUrl('app_ric')
            ],
            [
                "label" => "Retour à l'accueil",
                "url" => $this->generateUrl('app_main')
            ],
        ];
        
        return $this->render('pnum_program/index.html.twig', [
            'navItems' => $navItems,
        ]);
    }
}
