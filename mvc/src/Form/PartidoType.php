<?php

namespace App\Form;

use App\Entity\Cancha;
use App\Entity\Equipo;
use App\Entity\Partido;
use App\Entity\Zona;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cancha', EntityType::class, [
                'class' => Cancha::class,
'choice_label' => 'id',
            ])
            ->add('zona', EntityType::class, [
                'class' => Zona::class,
'choice_label' => 'id',
            ])
            ->add('equipoLocal', EntityType::class, [
                'class' => Equipo::class,
'choice_label' => 'id',
            ])
            ->add('equipoVisitante', EntityType::class, [
                'class' => Equipo::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partido::class,
        ]);
    }
}
