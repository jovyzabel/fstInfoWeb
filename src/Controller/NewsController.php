<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(Request $request ,ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {
        $data = $articleRepository->findAll();
        $articles = $paginator->paginate($data,1,6);

        return $this->render('news/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/news/show', name: 'app_news_show')]
    public function show(): Response
    {
        return $this->render('news/show.html.twig', [
        ]);
    }

    
}
