<?php

namespace App\Controller;

use App\Repository\SemesterRepository;
use App\Repository\TeacherRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function teachers(TeacherRepository $teacherRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $teacherRepository->findAll();
        $teachers = $paginator->paginate($data, $request->query->getInt('page',1),6);
        return $this->render('parcours/teachers.html.twig', [
            'teachers' => $teachers,
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
