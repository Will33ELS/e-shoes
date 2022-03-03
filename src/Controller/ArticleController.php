<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/add-article", name="add_article")
     */
    public function addArticle(Request $request, ManagerRegistry $doctrine){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($request->getMethod() == "POST"){
            $postRequest = $request->request;
            $articleName = $postRequest->get("article_name");
            $articleType = $postRequest->get("article_type");
            $articleSize = $postRequest->get("article_size");
            $articleImageURL= $postRequest->get("article_image_url");

            if(!empty($articleName) && !empty($articleType) && !empty($articleSize) && !empty($articleImageURL)){
                if($articleType != "chaussures" && $articleType != "tshirt"){
                    $this->addFlash('error', "Le type de l'article n'est pas supporté !");
                    return $this->redirectToRoute("add_article");
                }else {
                    if($articleType == "chaussures" && (intval($articleSize) < 36 || intval($articleSize) > 48)){
                        $this->addFlash('error', "La pointure doit être comprise entre 36 et 48");
                        return $this->redirectToRoute("add_article");
                    }else if($articleType == "tshirt"){
                        $size = ["XS", "S", "M", "L", "XL"];
                        if(!in_array($articleSize, $size)){
                            $this->addFlash('error', "Taille du tshirt invalide !");
                            return $this->redirectToRoute("add_article");
                        }
                    }

                    $article = new Article();
                    $article->setName($articleName);
                    $article->setType($articleType);
                    $article->setSize($articleSize);
                    $article->setImageURL($articleImageURL);
                    $article->setKeyword($postRequest->get("article_keyword"));

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($article);

                    $entityManager->flush();

                    $this->addFlash('success', "Article crée avec succès !");
                    return $this->redirectToRoute("home");
                }
            }else{
                $this->addFlash('error', "Tous les champs requis n'ont pas été complété !");
                return $this->redirectToRoute("add_article");
            }
        }
        return $this->render("admin/add-article.html.twig");
    }
}
