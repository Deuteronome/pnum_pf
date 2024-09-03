<?php

namespace App\Controller;

use App\Entity\RicParticipant;
use App\Entity\WarningRequest;
use App\Form\RicType;
use App\Form\WarningRequestType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;


class RicRegistartionController extends AbstractController
{
    #[Route('/ric', name: 'app_ric')]
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
          
        $navItems = [
            [
                "label" => "Accueil",
                "url" => $this->generateUrl('app_main')
            ],
            
        ];

        $participant = new RicParticipant();

        $form = $this->createForm(RicType::class, $participant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if($form->get('applicationType')->getData() === 'en direct') {
                $participant->setPrescribingStructure('en direct');
            }
            $em->persist($participant);
            
        try {
            $em->flush();
        } catch(Exception $e) {
            $this->addFlash('danger', 'une erreur s\'est produite, veuillez réessayer ultérieurement');
            return $this->redirectToRoute('app_main');
        }
            

            $emailAdmin = (new TemplatedEmail())
                ->from('admin@prepanum.e2c-app-factory.fr')
                ->to('o.burcker@e2c-grandlille.fr')
                ->replyTo($participant->getMail())
                ->subject('participation à une RIC')
                ->htmlTemplate('email/ricRegistration.html.twig')
                ->context(['data' => $participant]);

            try {
                $mailer->send($emailAdmin);
            } catch(TransportExceptionInterface $e) {
                $this->addFlash('danger', 'une erreur s\'est produite, veuillez réessayer ultérieurement');
                return $this->redirectToRoute('app_main');
            }
            
            $this->addFlash('success', 'Votre demande de participation a été transmise');

            $partAdmin = (new TemplatedEmail())
                ->from('admin@prepanum.e2c-app-factory.fr')
                ->to($participant->getMail())
                ->subject('ne pas répondre : confirmation d\'inscription à une RIC')
                ->htmlTemplate('email/ricConfirmation.html.twig')
                ->context(['data' => $participant]);

            try {
                $mailer->send($partAdmin);
            } catch(TransportExceptionInterface $e) {
                
            }


            return $this->redirectToRoute('app_main');
        }
        
        return $this->render('ric_registartion/index.html.twig', [
            'navItems' => $navItems,
            'form' => $form
        ]);
    }

    #[Route('/info', name:'app_warning_request')]
    public function warningRequest(Request $request, EntityManagerInterface $em, MailerInterface $mailer) : Response
    {
        $navItems = [
            [
                "label" => "Accueil",
                "url" => $this->generateUrl('app_main')
            ],
            
        ];

        $warningRequest = new WarningRequest();

        $form = $this->createForm(WarningRequestType::class, $warningRequest);
        $form-> handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($warningRequest);
            try {
                $em->flush();
            } catch(Exception $e) {
                $this->addFlash('danger', 'une erreur s\'est produite, veuillez réessayer ultérieurement');
                return $this->redirectToRoute('app_main');
            }

            $emailAdmin = (new TemplatedEmail())
                ->from('admin@prepanum.e2c-app-factory.fr')
                ->to('o.burcker@e2c-grandlille.fr')
                ->subject('demande d\'informations')
                ->htmlTemplate('email/warningRequest.html.twig')
                ->context(['data' => $warningRequest]);

            try {
                $mailer->send($emailAdmin);
            } catch(TransportExceptionInterface $e) {
                    
            }

            $this->addFlash('success', 'Vos coordonnées ont été enregistrées, vous serez prévenus quand les réunions seront programmées.');

            return $this->redirectToRoute('app_main');
        }
        
        return $this->render('ric_registartion/warning.html.twig', [
            'navItems' => $navItems,
            'form' => $form
        ]);
    }
}
