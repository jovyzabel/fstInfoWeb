<?php

namespace App\Controller;

use App\Data\SearchNews;
use App\Data\SearchPage;
use App\Form\SearchNewsType;
use App\Form\SearchPageType;
use App\Repository\PageRepository;
use App\Repository\AlumniRepository;
use App\Repository\ArticleRepository;
use App\Repository\PartnerRepository;
use App\Repository\AppOptionRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\FormationCycleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(private FormationCycleRepository $formationCycleRepository){}

    #[Route('/', name: 'app_home')]
    public function index(
        Request $request, 
        ArticleRepository $articleRepository, 
        PartnerRepository $partnerRepository, 
        AlumniRepository $alumniRepository
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findBy([], ['createdAt' => 'DESC'], 6),
            'carousel_items' => $articleRepository->findBy(['isOnCarousel' => true],['createdAt' => 'DESC'], 3),
            'partners' => $partnerRepository->findAll(),
            'alumnis' => $alumniRepository->findBy([], ['createdAt' => 'DESC'], 3),
            
        ]);
    }

    #[Route('/recherche', name: 'app_search')]
    public function search(Request $request , PaginatorInterface $paginator, ArticleRepository $articleRepository, PageRepository $pageRepository ): Response
    {
        $dataSearch = new SearchNews();
        $searchForm = $this->createForm(SearchNewsType::class, $dataSearch);
        $searchForm->handleRequest($request);

        
        if ($searchForm->isSubmitted() && $searchForm->isValid()){
            
            $pages = $pageRepository->findBysearch($dataSearch);
            $articles = $articleRepository->findBysearch($dataSearch);
            $data = array_merge($pages, $articles);
            $data = $paginator->paginate($data, $request->query->getInt('page', 1),6 );
            return $this->render('home/search_result.html.twig', [
                'data' => $data,
            ]);
        }
                
        return $this->render('home/_search.html.twig', [
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/specialites', name: 'app_specialities_list', methods: ['GET'])]
    public function coursesList(Request $request): JsonResponse
    {
        return $this->json($this->formationCycleRepository->findAll(),200,[],['groups' => 'get_formation_cycles']);
    }

    
}
