<?php

namespace App\Form;
// src/Form/Achat1Type.php

use App\Entity\Commande;
use App\Entity\Product;
use App\Entity\Achat; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Achat1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', IntegerType::class)
            ->add('commande', EntityType::class, [
                'class' => Commande::class,
                'choice_label' => 'id', // Display the ID of the Commande entity
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'id', // Display the ID of the product entity
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
