<?php

namespace App\Form;

use App\Entity\Depense;
// use App\Entity\Event;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('payment')
            ->add('type')
            ->add('prix')
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'required' => false, // Add this option
            ])          
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'required' => false, // Add this option
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}
