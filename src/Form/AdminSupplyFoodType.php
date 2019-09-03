<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\SupplyFood;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminSupplyFoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[

                'label' => 'Titre :'
            ])

            ->add('customer', EntityType::class,[

                'label' => 'Client :',
                'class' => Customer::class,
                'choice_label' => 'email',

            ])

            ->add('content', TextareaType::class,[

                'label' => 'Description :'

    ])
            ->add('price', TextType::class,[

                'label' => 'Prix :'
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Quantité :'
            ])
            ->add('label', ChoiceType::class, [
                'label' => 'Produits :',
                'choices' => [
                    'Nourriture' => '1',
                    'Boissons' => '2',
                    'Café'   => '3',
                    'Fruits' => '4',
                    'Menu' => '5',
                ],
            ])
            ->add('createdAt', DateType::class,[
                'label' => 'Date de commande :'
            ])
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
