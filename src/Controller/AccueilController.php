<?php

namespace App\Controller;
use App\Form\AdherentType;
use App\Entity\Adherent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    /**
     * @Route("/connecter", name="connecter")
     */
    public function connexion(Request $request,SessionInterface $session)
    {
        $form = $this->createFormBuilder(null)
            ->add('email', TextType::class,array('label' => 'Login'))
            ->add('mdp', PasswordType::class,array('label' => 'Mot de passe'))
            ->add('conn', SubmitType::class, array('label' => 'Se connecter'))
            ->getForm();
$form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
        // but, the original `$task` variable has also been updated
       $donne = $form->getData();
          
              
              $repository = $this->getDoctrine()->getRepository(Adherent::class);
              $adherent = $repository->findBy(['email' => $donne['email'],'mdp' => $donne['mdp']] );
              if(!empty($adherent))
          {
              $session->set('adherent',$adherent);
          }

        return $this->redirectToRoute('accueil');
    }
        return $this->render('accueil/connexion.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        // 1) build the form
        $adherent = new Adherent();
        $form = $this->createForm(AdherentType::class, $adherent);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            //$password = $passwordEncoder->encodePassword($adherent, $adherent->getMdp());
            //$adherent->setPassword($password);
            
            // 4) save the Adherent!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            return $this->redirectToRoute('connecter');
        }
        return $this->render('accueil/register.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Inscription']);
    }
    /**
     * @Route("/deconnecter", name="deconnecter")
     */
    public function deconnecterAction(Request $request, SessionInterface $session) {
       
        
        
        $session->remove('adherent');
        
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    
}
