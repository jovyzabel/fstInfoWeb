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
use App\Repository\SpecialityRepository;
use App\Repository\TeacherRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(
        private FormationCycleRepository $formationCycleRepository,
        private ArticleRepository $articleRepository,
        private SpecialityRepository $specialityRepository,  
        private PaginatorInterface $paginator,
        private TeacherRepository $teacherRepository

    ){}

    #[Route('/', name: 'app_home', methods:['GET'])]
    public function index(
        Request $request, 
        AlumniRepository $alumniRepository,
        PartnerRepository $partnerRepository,
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $this->articleRepository->findBy([], ['createdAt' => 'DESC'], 6),
            'carousel_items' => $this->articleRepository->findBy(['isOnCarousel' => true],['createdAt' => 'DESC'], 3),
            'partners' => $partnerRepository->findAll(),
            'alumnis' => $alumniRepository->findBy([], ['createdAt' => 'DESC'], 3),
            
        ]);
    }

    #[Route('/recherche', name: 'app_search', methods:['GET'])]
    public function search(Request $request,  PageRepository $pageRepository ): Response
    {
        $dataSearch = new SearchNews();
        $searchForm = $this->createForm(SearchNewsType::class, $dataSearch);
        $searchForm->handleRequest($request);

        
        if ($searchForm->isSubmitted() && $searchForm->isValid()){
            
            $pages = $pageRepository->findBysearch($dataSearch);
            $articles = $this->articleRepository->findBysearch($dataSearch);
            $specialities = $this->specialityRepository->findBysearch($dataSearch);
            $formationCycles = $this->formationCycleRepository->findBysearch($dataSearch);
            $teachers = $this->teacherRepository->findBysearch($dataSearch);
            $data = array_merge($pages, $articles, $formationCycles, $specialities, $teachers);
            $data = $this->paginator->paginate($data, $request->query->getInt('page', 1),6 );
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
