<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Entity\Teacher;
use App\Repository\AlumniRepository;
use App\Repository\FormationCycleRepository;
use App\Repository\TeacherRepository;
use App\Repository\SemesterRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/enseignants/{id}', name: 'app_parcours_teacher_show')]
    public function teacher(Teacher $teacher): Response
    {
        return $this->render('parcours/teacher.html.twig', [
            'teacher' => $teacher,
        ]);
    }    
    
    #[Route('/admission', name: 'app_admission')]
    public function admission(): Response
    {
        return $this->render('parcours/admission.html.twig', [
        ]);
    }

    #[Route('/cycles-de-formation', name: 'app_formation_cycles')]
    public function formationCycles(FormationCycleRepository $formationCycleRepository): Response
    {
        $licences = $formationCycleRepository->findOneBy(['label' => 'Licence']);
        $masters = $formationCycleRepository->findOneBy(['label' => 'Master']);
        $doctorats = $formationCycleRepository->findOneBy(['label' => 'Doctorat']);
        $certifications = $formationCycleRepository->findOneBy(['label' => 'Certification']);
        return $this->render('parcours/formation_cycles.html.twig', [
            'licences' => $licences,
            'masters' => $masters,
            'doctorats' => $doctorats,
            'certifications' => $certifications,
        ]);
    }

    #[Route('/cycles-de-formation/{slug}', name: 'app_formation_cycle')]
    public function formationCycle(): Response
    {
        return $this->render('parcours/formation_cycle.html.twig', []);
    }
    
    #[Route('/specialites/{slug}', name: 'app_speciality')]
    public function speciality(Speciality $speciality): Response
    {
        return $this->render('parcours/speciality.html.twig', [
            'speciality' => $speciality,
        ]);
    }
    
    
}

    // #[Route('/parcours/programmes', name: 'app_parcours_programs')]
    // public function programs(SemesterRepository $semesterRepository): Response
    // {
    //     return $this->render('parcours/programs.html.twig', [
    //         'semesters' => $semesterRepository->findAll(),
    //     ]);
    // }