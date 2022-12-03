<?php

namespace App\Controller;

use App\Repository\SemesterRepository;
use App\Repository\TeacherRepository;
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
    public function teachers(TeacherRepository $teacherRepository): Response
    {
        return $this->render('parcours/teachers.html.twig', [
            'teachers' => $teacherRepository->findAll(),
        ]);
    }

    #[Route('/parcours/programmes', name: 'app_parcours_programs')]
    public function programs(SemesterRepository $semesterRepository): Response
    {
        return $this->render('parcours/programs.html.twig', [
            'semesters' => $semesterRepository->findAll(),
        ]);
    }

    #[Route('/parcours/admission', name: 'app_parcours_admission')]
    public function admission(): Response
    {
        return $this->render('parcours/admission.html.twig', [
        ]);
    }

    
}
