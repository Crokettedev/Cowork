<?php

namespace App\Form;

use App\Entity\SpacePublic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpacePublicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', HiddenType::class)
            ->add('imageFile', FileType::class)
            ->add('title')
            ->add('content')
            ->add('created_at', HiddenType::class)
            ->add('image', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SpacePublic::class,
        ]);
    }
}
