<?php

namespace App\Controller;
use App\Entity\Adherent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
         /**
     * @Route("/userad", name="useradherent")
     */
    public function adherentsAction(): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
      
        $adherents = $this->getDoctrine()
            ->getRepository(Adherent::class)
            ->findBy(array('iduser' => $user->getId()));
          
        return $this->render('user/userad.html.twig', ['adherents' => $adherents]);
    }
    
}
