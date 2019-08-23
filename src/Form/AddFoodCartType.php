<?php

namespace App\Form;

use App\Entity\SupplyFood;
use App\Repository\SupplyFoodRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddFoodCartType extends AbstractType
{
    private $repo;

    public function __construct(SupplyFoodRepository $repo)
    {
        $this->repo = $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('food', EntityType::class, array(
                'label' => 'Choissiez un plat',
                'class' => SupplyFood::class,
                'choices' => $this->repo->findByLabel1(),
                'choice_label' => 'title',
            ))
            ->add('drink', EntityType::class, array(
                'label' => 'Choissiez une boisson',
                'class' => SupplyFood::class,
                'choices' => $this->repo->findByLabel2(),
                'choice_label' => 'title',
            ))
            ->add('coffee', EntityType::class, array(
                'label' => 'Choissiez une boisson',
                'class' => SupplyFood::class,
                'choices' => $this->repo->findByLabel3(),
                'choice_label' => 'title',
            ))
            ->add('fruit', EntityType::class, array(
                'label' => 'Choissiez une boisson',
                'class' => SupplyFood::class,
                'choices' => $this->repo->findByLabel4(),
                'choice_label' => 'title',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SupplyFood::class,
        ]);
    }
}
