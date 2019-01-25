<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 25/01/19
 * Time: 10:59
 */

namespace AppBundle\Services;

use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;



class UserService {

    private $em;

    public function __construct(EntityManagerInterface $em) { //Son constructeur avec l'entity manager en paramètre
        $this->em = $em;
    }

    public function addUser($data){


        $role = $this->em->getRepository(Role::class)->findOneBy(array('name'=> $data['role']));
        $user = new User();
        $user->setPseudo($data['pseudo'])->setName($data['name'])->setFirstname($data['firstname'])
        ->setActive(true)->setLogin($data['login'])->setPassword($data['password'])->setCreatedAt(new DateTime('NOW'))->setRole($role) ;

        $this->em->persist($user);
        $this->em->flush();

        return $this;
    }

    public function getAllUsers(){

        $users = $this->em->getRepository(User::class)->findAll();
        return $users;

    }

    public function getUserById($id){

        $user = $this->em->getRepository(User::class)->find($id);
        return $user;


    }

}