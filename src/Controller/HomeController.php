<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\FormationCycleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    public function __construct(private FormationCycleRepository $formationCycleRepository){}

    #[Route('/', name: 'app_home')]
    public function index(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {    
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findBy([], ['createdAt' => 'DESC'], 6),
            'carousel_items' => $articleRepository->findBy(['isOnCarousel' => true],['createdAt' => 'DESC'], 3)
            
        ]);
    }

    #[Route('/specialites', name: 'app_specialities_list', methods: ['GET'])]
    public function coursesList(Request $request): JsonResponse
    {
        return $this->json($this->formationCycleRepository->findAll(),200,[],['groups' => 'get_formation_cycles']);
    }

    
}
