<?php

namespace App\Controller;
use App\Entity\Adherent;
use App\Entity\Informationsup;
use App\Form\AdherentType;
use App\Form\InformationsupType;
use Doctrine\ORM\EntityManagerInterface;
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
    
    
        /**
     * @Route(" /userad/{idAdherent}/infosup_edit", name="useradinfosup_edit")
     */
    public function infosupAction(Request $request,Adherent $adherent)
    {
        $informationsup = new Informationsup();
        $form = $this->createForm(InformationsupType::class, $adherent->getInfosup());
          
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $informationsup = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($informationsup);
           
           $adherent->setInfosup($informationsup);
           $entityManager->flush();

       }
           return $this->render('user/infosup.html.twig', ['form' => $form->createView()]    ) ;
    }

    

    /**
     * @Route("/userad/{idAdherent}", name="useradadherent_show", methods={"GET"})
     */
    public function show(Adherent $adherent): Response
    {
        return $this->render('user/show.html.twig', ['adherent' => $adherent]);
    }
    

    /**
     * @Route("/userad/{idAdherent}/edit", name="useradadherent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adherent $adherent): Response
    {
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adherents', ['idAdherent' => $adherent->getIdAdherent()]);
        }

        return $this->render('user/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }




/**
     * @Route("/userad/{idAdherent}/show", name="useradinfosup_show", methods={"GET"})
     */
    public function infosupshow(Adherent $adherent): Response
    {
        return $this->render('user/infosup_show.html.twig', ['adherent' => $adherent]);
    }





    /**
     * @Route("/userad/{idAdherent}", name="useradadherent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Adherent $adherent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getIdAdherent(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adherent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('useradherent');
    }

    
    
}
