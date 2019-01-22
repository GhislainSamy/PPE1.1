<?php

namespace App\Form;

use App\Entity\Informationsup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class InformationsupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeMailing',TextType::class, array('label' => 'Type Mailing'  ))
            ->add('accident',TextType::class, array('label' => 'Accident'  ))
            ->add('droitimage',TextType::class, array('label' => 'Droit a limage'  ))
            ->add('infocomplem',TextType::class, array('label' => 'Info Complementaire'  ))
            ->add('assurance',TextType::class, array('label' => 'Assurance'  ))
            ->add('optionassurance',TextType::class, array('label' => 'Option Assurance'  ))
            ->add('typePaiement',TextType::class, array('label' => 'Type de paiement'  ))
            ->add('niveauTechnique',TextType::class, array('label' => 'Niveau Technique'  ))
            ->add('dateCreation',DateTimeType::class, array('label' => 'Date de création'))
            ->add('demandeFacture',TextType::class, array('label' => 'Demande Facture'  ))
            ->add('passJeune',TextType::class, array('label' => 'Pass Jeune'  ))
            ->add('dossierComplet',TextType::class, array('label' => 'Dossier Complet'  ))
            ->add('save', SubmitType::class, array('label' => 'Sauvegarder'  ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Informationsup::class,
        ]);
    }
}
