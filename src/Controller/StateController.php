<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\AcademicYear;
use App\Entity\AppOption;
use App\Entity\PreRegistration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StateController extends AbstractController
{
    #[Route('/state', name: 'app_state')]
    public function index(): Response
    {
        return $this->render('state/index.html.twig', [
            'controller_name' => 'StateController',
        ]);
    }

    #[Route('/fiche-preinscription/{id}', name: 'app_state_fiche_pre_inscription_slip')]
    public function preinscription(PreRegistration $preRegistration, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'année académique ouverte depuis la base de données.
        $academicYear = $entityManager->getRepository(AppOption::class)->find(1)->getCurrentAcademicYear();

        $html = $this->render('state/preinscription.html.twig', [
            'academicYear' => $academicYear->getLabel(),
            'preInscription' => $preRegistration,
        ]);

        $pdfOptions = new Options();
        $pdfOptions->setIsRemoteEnabled(true);

        // Créer une instance de Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html->getContent());
        $dompdf->setPaper('A4', 'portrait'); // Définir le format du papier (A4) et l'orientation (portrait)
        $dompdf->render();

        // Récupérer le contenu PDF généré
        $pdfContent = $dompdf->output();
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="fichePreinscription.pdf"',
        ]);
    }
}
