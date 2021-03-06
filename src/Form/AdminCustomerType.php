<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdminCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail *', 'required' => true,
                'attr' => [
                    'placeholder' => 'E-mail'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe *', 'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe'
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Nom *', 'required' => true,
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prénom *', 'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone *', 'required' => true,
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('society', TextType::class, [
                'label' => 'Entreprise', 'required' => true,
                'attr' => [
                    'placeholder' => 'Nom de votre entreprise'
                ]
            ])
            ->add('job', TextType::class, [
                'label' => 'Profession', 'required' => false,
                'attr' => [
                    'placeholder' => 'Ex : Développeur, Commercial, Ingénieur'
                ]
            ])

            ->add('imageFile', FileType::class, [
                'label' => 'Photo de profil','required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
            'translation_domain' => 'forms'
        ]);
    }
}
