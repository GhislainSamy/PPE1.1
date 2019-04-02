<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, array('label' => 'Nom d utilisateur'  ))
/*             ->add('roles', ChoiceType::class, [
                    'choices' => ['ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER'],
                    'expanded' => true,
                    'multiple' => true,
                ]
            ) */
            ->add('password',PasswordType::class, array('label' => 'Mot de Passe'))
            ->add('telephone',TextType::class, array('label' => 'Téléphone'  ))
            ->add('email')
            ->add('adresse')
            ->add('ville')
            ->add('cp',TextType::class, array('label' => 'Code postal'  ))
/*             ->add('dateajout',DateTimeType::class, array('label' => 'Date de création'  ))
 */            ->add('save', SubmitType::class, array('label' => 'Sauvegarder'  ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
