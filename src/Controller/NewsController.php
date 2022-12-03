<?php

namespace App\Controller;

use App\Entity\Article;
use App\Data\SearchNews;
use App\Form\SearchNewsType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    public function __construct(private ArticleRepository $articleRepository)
    {
        
    }

    #[Route('/news', name: 'app_news')]
    public function index(Request $request , PaginatorInterface $paginator): Response
    {
        $dataSearch = new SearchNews();
        $form = $this->createForm(SearchNewsType::class, $dataSearch);

        $form->handleRequest($request);
        $data = $this->articleRepository->findAll();
        $articles = $paginator->paginate($data, $request->query->getInt('page', 1),6);

        return $this->render('news/index.html.twig', [
            'articles' => $articles,
            'latest_articles' => $this->articleRepository->findBy([], ['createdAt' => 'ASC'], 5),
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/news/result', name: 'app_news_result')]
    public function searchResult(Request $request , PaginatorInterface $paginator): Response
    {
        $dataSearch = new SearchNews();
        $form = $this->createForm(SearchNewsType::class, $dataSearch);
        $form->handleRequest($request);
        $data = $this->articleRepository->findBysearch($dataSearch);
        $articles = $paginator->paginate($data, $request->query->getInt('page', 1),6 );

        return $this->render('news/search_result.html.twig', [
            'articles' => $articles,
            'latest_articles' => $this->articleRepository->findBy([], ['createdAt' => 'ASC'], 5),
            'form' => $form->createView()
        ]);
    }

    #[Route('/news/{slug}', name: 'app_news_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        $dataSearch = new SearchNews();
        $form = $this->createForm(SearchNewsType::class, $dataSearch);

        return $this->render('news/show.html.twig', [
            'article' => $article,
            'latest_articles' => $this->articleRepository->findBy([], ['createdAt' => 'ASC'], 5),
            'form' => $form->createView()
        ]);
    }

    
}
