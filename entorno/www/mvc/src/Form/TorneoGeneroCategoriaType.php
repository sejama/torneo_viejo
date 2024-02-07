<?php

namespace App\Form;

use App\Entity\TorneoGeneroCategoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TorneoGeneroCategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('torneo', EntityType::class, [
                'class' => 'App\Entity\Torneo',
                'choice_label' => 'nombre',
            ])
            ->add('genero', EntityType::class, [
                'class' => 'App\Entity\Genero',
                'choice_label' => 'nombre',
            ])
            ->add('categoria', EntityType::class, [
                'class' => 'App\Entity\Categoria',
                'choice_label' => 'nombre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TorneoGeneroCategoria::class,
        ]);
    }
}
