<?php

namespace App\Controller;

use App\Entity\FormationCycle;
use App\Entity\Speciality;
use App\Entity\Teacher;
use App\Repository\AlumniRepository;
use App\Repository\FormationCycleRepository;
use App\Repository\PartnerRepository;
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
    public function presentation(PartnerRepository $partnerRepository): Response
    {
        return $this->render('parcours/programs.html.twig', [
            'partners' => $partnerRepository->findAll(),
        ]);
    }

    #[Route('/parcours/mot-du-responsable', name: 'app_parcours_chief_word', methods:['GET'])]
    public function chiefWord(): Response
    {
        return $this->render('parcours/chief_word.html.twig', [
        ]);
    }

    #[Route('/parcours/enseignants', name: 'app_parcours_teachers', methods:['GET'])]
    public function teachers(TeacherRepository $teacherRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $teacherRepository->findAll();
        $teachers = $paginator->paginate($data, $request->query->getInt('page',1),6);
        return $this->render('parcours/teachers.html.twig', [
            'teachers' => $teachers,
        ]);
    }

    #[Route('/enseignants/{id}', name: 'app_parcours_teacher_show', methods:['GET'])]
    public function teacher(Teacher $teacher): Response
    {
        return $this->render('parcours/teacher.html.twig', [
            'teacher' => $teacher,
        ]);
    }    
    
    #[Route('/admission', name: 'app_admission', methods:['GET'])]
    public function admission(): Response
    {
        return $this->render('parcours/admission.html.twig', [
        ]);
    }

    #[Route('/cycles-de-formation', name: 'app_formation_cycles', methods:['GET'])]
    public function formationCycles(FormationCycleRepository $formationCycleRepository): Response
    {
        $licence = $formationCycleRepository->findOneBy(['label' => 'Licence']);
        $master = $formationCycleRepository->findOneBy(['label' => 'Master']);
        $doctorat = $formationCycleRepository->findOneBy(['label' => 'Doctorat']);
        $certification = $formationCycleRepository->findOneBy(['label' => 'Certification']);
        return $this->render('parcours/formation_cycles.html.twig', [
            'licence' => $licence,
            'master' => $master,
            'doctorat' => $doctorat,
            'certification' => $certification,
        ]);
    }

    #[Route('/specialites/{slug}', name: 'app_formation_cycle', methods:['GET'])]
    public function formationCycle(FormationCycle $formationCycle): Response
    {
        return $this->render('parcours/formation_cycle.html.twig', [
            'formation_cycle' => $formationCycle,
        ]);
    }
    
    #[Route('/specialites/{formation_cycle_slug}/{slug}', name: 'app_speciality', methods:['GET'])]
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