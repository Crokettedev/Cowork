<?php

namespace App\Form;

use App\Entity\PlacePublic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminPlacePublicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'choices' => [
                    'Place 1' => 'Place 1',
                    'Place 2' => 'Place 2',
                    'Place 3'   => 'Place 3',
                    'Place 4' => 'Place 4',
                    'Place 5' => 'Place 5',
                    'Place 6' => 'Place 6',

                ],
                'label' => 'Choisir une place :',
            ])
            ->add('price', NumberType::class,[
                'label' => 'Prix :',
    ])
            ->add('customer', NULL,[

                'label' => 'Client :',

                ])

            ->add('place_public', HiddenType::class)
            ->add('beginAt', NULL,[

                'label' => 'Date de début :',
            ])
            ->add('endAt', NULL,[

                'label' => 'Date de fin :',
            ])

            ->add('disponible', NULL,[

                'label' => 'Réserver ',
            ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlacePublic::class,
        ]);
    }
}
