<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 25/01/19
 * Time: 14:21
 */

namespace AppBundle\Controller;


use AppBundle\Services\ArticleService;
use AppBundle\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Services\RoleService;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller{


    /**
     * @Route("/addarticle", name="addarticle")
     */
    public function addArticleAction(UserService $userService){

        $users = $userService->getAllUsers();

        return $this->render('default/addarticle.html.twig', ['users'=>$users]);
    }

    /**
     * @Route("/addarticleApi", name="addarticleApi")
     */
    public function addArticleApiAction(Request $request, ArticleService $articleService){

        $data['title']= $request->get('title');
        $data['body']= $request->get('body');
        $data['pseudo']= $request->get('pseudo');

        $articleService->addArticle($data);

        return $this->redirectToRoute('role');
    }

    /**
     * @Route("/articles", name="articles")
     *
     */
    public function articlesAction(ArticleService $articleService){
        $articles = $articleService->getAllArticles();

        return $this->render('default/articles.html.twig', ['articles'=>$articles]);
    }


}