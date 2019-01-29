<?php

namespace App\Controller;
use App\Entity\Adherent;
use App\Entity\Informationsup;
use App\Form\AdherentType;
use App\Form\InformationsupType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    
    
     /**
     * @Route("/adherents", name="adherents")
     */
    public function adherentsAction(): Response
    {
        
        $adherents = $this->getDoctrine()
            ->getRepository(Adherent::class)
            ->findAll();

        return $this->render('admin/adherents.html.twig', ['adherents' => $adherents]);
    }
    /**
     * @Route(" /adherent/{idAdherent}/infosup_edit", name="infosup_edit")
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
           return $this->render('admin/infosup.html.twig', ['form' => $form->createView()]    ) ;
    }

    

    /**
     * @Route("/adherent/{idAdherent}", name="adherent_show", methods={"GET"})
     */
    public function show(Adherent $adherent): Response
    {
        return $this->render('admin/show.html.twig', ['adherent' => $adherent]);
    }
    

    /**
     * @Route("/adherent/{idAdherent}/edit", name="adherent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adherent $adherent): Response
    {
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adherents', ['idAdherent' => $adherent->getIdAdherent()]);
        }

        return $this->render('admin/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }




/**
     * @Route("/adherent/{idAdherent}/show", name="infosup_show", methods={"GET"})
     */
    public function infosupshow(Adherent $adherent): Response
    {
        return $this->render('admin/infosup_show.html.twig', ['adherent' => $adherent]);
    }





    /**
     * @Route("/adherent/{idAdherent}", name="adherent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Adherent $adherent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getIdAdherent(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adherent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adherents');
    }
}