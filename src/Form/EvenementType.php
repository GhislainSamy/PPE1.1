<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, array('label' => 'Titre'  ))
            ->add('description',TextType::class, array('label' => 'Description'  ))
            ->add('adresse',TextType::class, array('label' => 'Adresse'  ))
            ->add('dateDebut',DateTimeType::class, array('label' => 'Date de debut'  ))
            ->add('dateFin',DateTimeType::class, array('label' => 'Date de fin'  ))
            ->add('save', SubmitType::class, array('label' => 'Sauvegarder'  ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
