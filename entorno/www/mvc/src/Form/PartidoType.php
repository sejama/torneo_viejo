<?php

namespace App\Form;

use App\Entity\Cancha;
use App\Entity\Club;
use App\Entity\Equipo;
use App\Entity\Partido;
use App\Entity\Zona;
use Doctrine\ORM\EntityRepository;
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
                'choice_label' => function (Cancha $cancha) {
                    return $cancha->getClub()->getNombre() . ' - ' . $cancha->getNombre();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.club', 'ASC')
                        ->addOrderBy('c.nombre', 'ASC');
                },
                'required' => false,
                'placeholder' => 'Seleccione una cancha',
            ])
            ->add('zona', EntityType::class, [
                'class' => Zona::class,
                'choice_label' => 'id',
                'placeholder' => 'Seleccione una zona',
                'required' => false,
            ])
            ->add('equipoLocal', EntityType::class, [
                'class' => Equipo::class,
                'choice_label' => 'nombre',
            ])
            ->add('equipoVisitante', EntityType::class, [
                'class' => Equipo::class,
                'choice_label' => 'nombre',
            ])
            ->add('localSet1', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('localSet2', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('localSet3', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('localSet4', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('localSet5', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('visitanteSet1', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('visitanteSet2', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('visitanteSet3', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('visitanteSet4', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('visitanteSet5', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ])
            ->add('horario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partido::class,
        ]);
    }
}
