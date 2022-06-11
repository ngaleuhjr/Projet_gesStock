<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Roles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Role\Role;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class,array('label'=>'Préom', 'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('nom', TextType::class,array('label'=>'Nom', 'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('email', EmailType::class,array('label'=>'Adresse email', 'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('password', PasswordType::class,array('label' => 'Mot de passe', 'attr' => array('require' => 'require','class' => 'form-control form-group')))
            //->add('roles', EntityType::class,array('class' => Roles::class,'label' => 'Rôle de l\'utilisateur', 'attr' => array('require' => 'require','class' => 'form-control form-group')))
            ->add('Valider', SubmitType::class,array('attr' => array('class' => 'btn btn-success form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}