<?php

namespace App\Form;

use App\Entity\SupplyOffice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SupplyOfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Titre'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un titre',
                    ]),
                ]])
            ->add('content', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Description'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez une description',
                    ]),
                ]])
            ->add('price', NumberType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prix'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un prix',
                    ]),
                ]])
            ->add('stock', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Stock'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un nombre pour le stock',
                    ]),
                ]])
            ->add('label', ChoiceType::class, [
                'choices' => [
                    'Clé USB' => '1',
                    'Disque dur' => '2',
                    'Papeterie'   => '3',
                    'Cloud' => '4',
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image','required' => false,
                'attr' => [
                    'placeholder' => 'Image'
                ]
            ])
            ->add('createdAt', HiddenType::class)
            ->add('updateAt', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SupplyOffice::class,
            'translation_domain' => 'forms'
        ]);
    }
}
