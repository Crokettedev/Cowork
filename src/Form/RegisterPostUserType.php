<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\RegisterPost;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterPostUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', EntityType::class, [
                'label' => 'Nom',
                'class' => Customer::class,
                'choice_label' => 'firstname',

            ])
            ->add('lastname', EntityType::class, [
                'label' => 'Nom',
                'class' => Customer::class,
                'choice_label' => 'lastname',

            ])
            ->add('createdAt', HiddenType::class)
            ->add('email', EntityType::class, [
                'label' => 'Nom',
                'class' => Customer::class,
                'choice_label' => 'email',

            ])
            ->add('post', HiddenType::class)
            ->add('user', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterPost::class,
            'translation_domain' => 'forms'
        ]);
    }
}
