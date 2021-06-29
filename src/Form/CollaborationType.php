<?php

namespace App\Form;

use App\Entity\Collaboration;
use App\Entity\Freelancer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollaborationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('remuneration')
            ->add('freelancer', EntityType::class, [
                'class' => Freelancer::class,
                'choice_label' => function ($freelancer) {
                    return $freelancer->getUsername() . ' ' . $freelancer->getCategorie();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaboration::class,
        ]);
    }
}
