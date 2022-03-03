<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $articles = $doctrine->getRepository(Article::class)->findAll();
        return $this->render('home/index.html.twig', [
            "articles" => $articles
        ]);
    }

    /**
     * @Route("/", name="search", methods={"POST"})
     */
    public function search(Request $request, ManagerRegistry $doctrine): Response
    {
        if($request->request->has("search")) {
            $search = $request->request->get("search");
            $repository = $doctrine->getRepository(Article::class);
            return $this->render("home/index.html.twig", [
                "articles" => $repository->findBySearch($search),
                "search" => $search
            ]);
        }else if($request->request->has("filter_type")){
            $repository = $doctrine->getRepository(Article::class);
            $type = $request->request->get("filter_type");
            $size = $request->request->get("filter_size");
            if(empty($size)) $size = null;
            return $this->render("home/index.html.twig", [
                "articles" => $repository->findByFilter($type, $size),
                "filter" => ["type" => $type, "size" => $size]
            ]);
        }
        return $this->redirectToRoute("home");
    }

}
