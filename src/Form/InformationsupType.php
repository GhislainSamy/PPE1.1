<?php

namespace App\Form;

use App\Entity\Informationsup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InformationsupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeMailing')
            ->add('accident')
            ->add('droitimage')
            ->add('infocomplem')
            ->add('assurance')
            ->add('optionassurance')
            ->add('typePaiement')
            ->add('niveauTechnique')
            ->add('dateCreation')
            ->add('demandeFacture')
            ->add('passJeune')
            ->add('dossierComplet')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Informationsup::class,
        ]);
    }
}
