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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;





class AdherentController extends AbstractController
{
    /**
     * @Route("/useradd", name="user")
     */
    public function index()
    {
        return $this->render('userad/index.html.twig', [
            'controller_name' => 'AdherentController',
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
          
        return $this->render('userad/userad.html.twig', ['adherents' => $adherents]);
    }
        
    /**
     * @Route("/userad/newsportif", name="useradadherent_new")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        // 1) build the form
        $adherent = new Adherent();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(AdherentType::class, $adherent);
      
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            //$password = $passwordEncoder->encodePassword($adherent, $adherent->getMdp());
            //$adherent->setPassword($password);
            
            // 4) save the Adherent!
            $entityManager = $this->getDoctrine()->getManager();
            $adherent->setIduser($user);
            $entityManager->persist($adherent);
            
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            return $this->redirectToRoute('useradherent');
        }
        return $this->render('userad/register.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Inscription']);
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
           return $this->render('userad/infosup.html.twig', ['form' => $form->createView()]    ) ;
    }
    
    /**
     * @Route("/userad/{idAdherent}", name="useradadherent_show", methods={"GET"})
     */
    public function show(Adherent $adherent): Response
    {
        return $this->render('userad/show.html.twig', ['adherent' => $adherent]);
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
        return $this->render('userad/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }
/**
     * @Route("/userad/{idAdherent}/show", name="useradinfosup_show", methods={"GET"})
     */
    public function infosupshow(Adherent $adherent): Response
    {
        return $this->render('userad/infosup_show.html.twig', ['adherent' => $adherent]);
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