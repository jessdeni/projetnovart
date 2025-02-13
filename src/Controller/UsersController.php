<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
    /**
     * @Route("/users/add", name="users_add")
     */
    public function add(Request $request)
    {
        $users = new Users;
        $formUser = $this->createForm(UsersType::class,$users);
        
        
        $formUser->handleRequest($request);
        if($formUser->isSubmitted() && $formUser->isValid())
        {
         $entityManger = $this->getDoctrine()->getManager();
         $entityManger->persist($users);
         $entityManger->flush();

         return $this->redirectToRoute('index');
        }                   

        return $this->render('users/form-add.html.twig',[
             'formUser' =>$formUser->createView()
        ]);

   
        

        
    } 
}
