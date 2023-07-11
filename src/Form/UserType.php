<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir une adresse email.']),
                new Email(['message' => 'Veuillez saisir une adresse email valide.']),
            ],
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent correspondre.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmer le mot de passe'],
            'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir un mot de passe.']),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                ]),
            ],
        ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ManagerCommunity' => 'ManagerCommunity',
                    'BuyerManagerSalary' => 'BuyerManagerSalary',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles',
            ])
            
            ->add('NomC')
            ->add('photoFile', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image au format JPEG ou PNG.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
