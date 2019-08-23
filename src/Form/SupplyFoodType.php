<?php

namespace App\Form;

use App\Entity\SupplyFood;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplyFoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('price')
            ->add('stock')
            ->add('label', ChoiceType::class, [
                'choices' => [
                    'Nourriture' => '1',
                    'Boissons' => '2',
                    'Café'   => '3',
                    'Fruits' => '4',
                    'Menu' => '5',
                ],
            ])
            ->add('createdAt', HiddenType::class)
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SupplyFood::class,
        ]);
    }
}
