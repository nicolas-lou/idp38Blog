<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Services\RoleService;
use AppBundle\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/role", name="role")
     * @param RoleService $roleService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function roleAction(RoleService $roleService){
       $roles = $roleService->getAllRoles();

        return $this->render('default/role.html.twig', ['roles'=>$roles]);
    }


    /**
     * @Route("/user", name="user")
     *
     */
    public function userAction(UserService $userService){
        $users = $userService->getAllUsers();

        return $this->render('default/user.html.twig', ['users'=>$users]);
    }

    /**
     * @Route("/adduserApi", name="adduserApi")
     */
    public function addUserApiAction(Request $request, UserService $userService){

        $data['pseudo']= $request->get('pseudo');
        $data['name']= $request->get('name');
        $data['firstname']= $request->get('firstname');
        $data['login']= $request->get('login');
        $data['password']= $request->get('password');
        $data['role']= $request->get('role');

        $userService->addUser($data);

        return $this->redirectToRoute('role');
    }

    /**
     * @Route("/adduser", name="adduser")
     */
    public function addUserAction(RoleService $roleService){

        $roles = $roleService->getAllRoles();

        return $this->render('default/adduser.html.twig', ['roles'=>$roles]);
    }
}
