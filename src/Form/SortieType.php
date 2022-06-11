<?php

namespace App\Form;

use App\Entity\Sortie;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('produit', EntityType::class,array('class' => Produit::class,'label' => 'Produit en sortie', 'attr' => array('require' => 'require','class' => 'form-control form-group')))
            
        ->add('qteSortie', TextType::class,array('label' => 'Quantité sortie', 'attr' => array('require' => 'require','class' => 'form-control form-group')))
        
        ->add('prixSortie', TextType::class,array('label' => 'Prix du produit', 'attr' => array('require' => 'require','class' => 'form-control form-group')))
        
        ->add('dateSortie',DateType::class,array('label' => 'Date de sortie', 'attr' => array('require' => 'require','class' => 'form-control form-group')))
        
        ->add('Valider', SubmitType::class,array('attr' => array('class' => 'btn btn-success form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}