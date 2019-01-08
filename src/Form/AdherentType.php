<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sexe',TextType::class, array('label' => 'Sexe'  ))
            ->add('nom',TextType::class, array('label' => 'Nom'))
            ->add('prenom',TextType::class, array('label' => 'Prénom'))
            ->add('datenaiss',DateType::class, array('label' => 'Date de Naissance'))
            ->add('nationalite',TextType::class, array('label' => 'Nationalité'))
            ->add('telephone',TextType::class, array('label' => 'Téléphone'))
            ->add('adresse',TextType::class, array('label' => 'Adresse'))
            ->add('cp',TextType::class, array('label' => 'Code Postale'))
            ->add('ville',TextType::class, array('label' => 'Ville'))
            ->add('email',TextType::class, array('label' => 'Email'))
            ->add('mdp',PasswordType::class, array('label' => 'Mot de Passe'))
            ->add('dateCreation',DateTimeType::class, array('label' => 'Date de création'))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
