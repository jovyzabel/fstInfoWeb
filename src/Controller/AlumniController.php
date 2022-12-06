<?php

namespace App\Controller;

use App\Repository\AlumniRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlumniController extends AbstractController
{
    #[Route('/alumni', name: 'app_alumni')]
    public function index(AlumniRepository $alumniRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $alumniRepository->findAll();
        $alumnies = $paginator->paginate($data, $request->query->getInt('page', 1), 6);
        return $this->render('alumni/index.html.twig', [
            'alumnies' => $alumnies, 
        ]);
    }
}
