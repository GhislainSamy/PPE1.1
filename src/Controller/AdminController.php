<?php

namespace App\Controller;
use App\Entity\Adherent;
use App\Form\AdherentType;
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
     * @Route("/infosup", name="infosup")
     */
    public function infosupAction(Request $request,SessionInterface $session)
    {
        return $this->render('admin/infosup.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    
}
    

    /**
     * @Route("/{idAdherent}", name="adherent_show", methods={"GET"})
     */
    public function show(Adherent $adherent): Response
    {
        return $this->render('admin/show.html.twig', ['adherent' => $adherent]);
    }

    /**
     * @Route("/{idAdherent}/edit", name="adherent_edit", methods={"GET","POST"})
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
     * @Route("/{idAdherent}", name="adherent_delete", methods={"DELETE"})
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