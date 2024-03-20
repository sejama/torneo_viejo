<?php

namespace App\Form;

use App\Entity\Cuartos;
use App\Entity\Fin;
use App\Entity\PlayOff;
use App\Entity\Semis;
use App\Entity\TorneoGeneroCategoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayOffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('torneoGeneroCategoria', EntityType::class, [
                'class' => TorneoGeneroCategoria::class,
'choice_label' => 'id',
            ])
            ->add('cuartos', EntityType::class, [
                'class' => Cuartos::class,
'choice_label' => 'id',
            ])
            ->add('semis', EntityType::class, [
                'class' => Semis::class,
'choice_label' => 'id',
            ])
            ->add('fin', EntityType::class, [
                'class' => Fin::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayOff::class,
        ]);
    }
}
