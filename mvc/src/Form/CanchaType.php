<?php

namespace App\Form;

use App\Entity\Cancha;
use App\Entity\Club;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CanchaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('club', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'nombre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cancha::class,
        ]);
    }
}
