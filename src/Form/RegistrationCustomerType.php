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

class RegistrationCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false, 'required' => true,
                'attr' => [
                    'placeholder' => 'E-mail'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => false, 'required' => true,
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
                'label' => false, 'required' => true,
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => false, 'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => false, 'required' => true,
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Vous êtes d\'accord avec les termes de réglementation de Gusto', 'mapped' => false, 'required' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez.',
                    ]),
                ],
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
