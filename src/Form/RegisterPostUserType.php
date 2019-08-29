<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\RegisterPost;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterPostUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom', 'required' => true,
                'attr' => [
                    'placeholder' => 'Nom'
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prénom', 'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom'
                ],
            ])
            ->add('createdAt', HiddenType::class)
            ->add('email', EmailType::class, [
                'label' => 'E-mail', 'required' => true,
                'attr' => [
                    'placeholder' => 'E-mail'
                ],
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
