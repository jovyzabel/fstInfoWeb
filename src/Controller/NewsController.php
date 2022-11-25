<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends AbstractController
{
    public function __construct(private ArticleRepository $articleRepository)
    {
        
    }

    #[Route('/news', name: 'app_news')]
    public function index(Request $request , PaginatorInterface $paginator): Response
    {
        $data = $this->articleRepository->findAll();
        $articles = $paginator->paginate($data, $request->query->getInt('page', 1),6);

        return $this->render('news/index.html.twig', [
            'articles' => $articles,
            'latest_articles' => $this->articleRepository->findBy([], ['createdAt' => 'ASC'], 6)
        ]);
    }

    #[Route('/news/{slug}', name: 'app_news_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('news/show.html.twig', [
            'article' => $article,
            'latest_articles' => $this->articleRepository->findBy([], ['createdAt' => 'ASC'], 6)
        ]);
    }

    
}
