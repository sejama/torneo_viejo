<?php

namespace App\Form;

use App\Entity\Fin;
use App\Entity\Partido;
use App\Entity\PlayOff;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('partido1', EntityType::class, [
                'class' => Partido::class,
'choice_label' => 'id',
            ])
            ->add('playOff', EntityType::class, [
                'class' => PlayOff::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fin::class,
        ]);
    }
}
