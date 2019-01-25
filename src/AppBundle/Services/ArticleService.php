<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 25/01/19
 * Time: 14:29
 */

namespace AppBundle\Services;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;


class ArticleService{

    private $em;

    public function __construct(EntityManagerInterface $em) { //Son constructeur avec l'entity manager en paramètre
        $this->em = $em;
    }

    public function addArticle($data){


        $user = $this->em->getRepository(User::class)->findOneBy(array('pseudo'=> $data['pseudo']));
        $article = new Article();
        $article->setTitle($data['title'])
            ->setBody($data['body'])
            ->setStatus("publié")
            ->setCreatedAt(new DateTime('NOW'))
            ->setUpdatedAt(new DateTime('NOW'))
            ->setUser($user) ;

        $this->em->persist($article);
        $this->em->flush();

        return $this;
    }

    public function getAllArticles(){

        $articles = $this->em->getRepository(Article::class)->findAll();
        return $articles;

    }

    public function getArticleById($id){

        $article = $this->em->getRepository(Article::class)->find($id);
        return $article;


    }

}