<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 25/01/19
 * Time: 10:26
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;




class RoleService{

    private $em;

    public function __construct(EntityManagerInterface $em) { //Son constructeur avec l'entity manager en paramètre
        $this->em = $em;
    }



    public function addRole($roleName){


        $role = new Role();
        $role->setName($roleName);

        $this->em->persist($role);
        $this->em->flush();

        return $this;
    }



    public function getAllRoles(){

        return $this->em->getRepository(Role::class)->findAll();

    }

    public function getRoleById($id){

        return $this->em->getRepository(Role::class)->find($id);



    }

}