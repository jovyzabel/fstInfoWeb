<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcoursController extends AbstractController
{
    #[Route('/parcours/presentation', name: 'app_parcours_presentation')]
    public function presentation(): Response
    {
        return $this->render('parcours/presentation.html.twig', [
        ]);
    }

    #[Route('/parcours/mot-du-responsable', name: 'app_parcours_chief_word')]
    public function chiefWord(): Response
    {
        return $this->render('parcours/chief_word.html.twig', [
        ]);
    }

    #[Route('/parcours/enseignants', name: 'app_parcours_teachers')]
    public function teachers(): Response
    {
        return $this->render('parcours/teachers.html.twig', [
        ]);
    }

    
}
