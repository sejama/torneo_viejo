<?php

namespace App\Form;

use App\Entity\ZonaEquipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZonaEquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zona', EntityType::class, [
                'class' => 'App\Entity\Zona',
                'choice_label' => 'id',
                'placeholder' => 'Seleccione una zona',
                'required' => true,
            ])
            ->add('equipo', EntityType::class, [
                'class' => 'App\Entity\Equipo',
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione un equipo',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ZonaEquipo::class,
        ]);
    }
}
