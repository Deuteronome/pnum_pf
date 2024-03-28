<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InProgressController extends AbstractController
{
    #[Route('/enCours', name: 'app_in_progress')]
    public function index(): Response
    {
        $navItems = [
            [
                "label" => "Accueil",
                "url" => $this->generateUrl('app_main')
            ],
            
        ];
        
        return $this->render('in_progress/index.html.twig', [
            'navItems' => $navItems,
        ]);
    }
}
