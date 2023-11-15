<?php

namespace App\Form;

use App\Entity\Equipo;
use App\Entity\TorneoGeneroCategoria;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class EquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('torneoGeneroCategoria', EntityType::class, [
                'class' => TorneoGeneroCategoria::class,
                'choice_label' => function (TorneoGeneroCategoria $torneoGeneroCategoria) {
                    return $torneoGeneroCategoria->getTorneo()->getNombre() . ' - ' . $torneoGeneroCategoria->getGenero()->getNombre() . ' - ' . $torneoGeneroCategoria->getCategoria()->getNombre();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tgc')
                        ->orderBy('tgc.torneo', 'ASC')
                        ->addOrderBy('tgc.genero', 'ASC')
                        ->addOrderBy('tgc.categoria', 'ASC');
                },
                'choice_attr' => function (TorneoGeneroCategoria $torneoGeneroCategoria) {
                    return ['data-torneo' => $torneoGeneroCategoria->getTorneo()->getId(), 'data-genero' => $torneoGeneroCategoria->getGenero()->getId(), 'data-categoria' => $torneoGeneroCategoria->getCategoria()->getId()];
                },
                'group_by' => function (TorneoGeneroCategoria $torneoGeneroCategoria) {
                    return $torneoGeneroCategoria->getTorneo()->getNombre() . ' - ' . $torneoGeneroCategoria->getGenero()->getNombre();
                },
                'placeholder' => 'Seleccione un torneo, género y categoría',
                /*'required' => true,
                'constraints' => [
                    new Choice([
                        'choices' => function (TorneoGeneroCategoria $torneoGeneroCategoria) {
                            return $torneoGeneroCategoria->getTorneo()->getNombre() . ' - ' . $torneoGeneroCategoria->getGenero()->getNombre() . ' - ' . $torneoGeneroCategoria->getCategoria()->getNombre();
                        },
                        'message' => 'Seleccione un torneo, género y categoría',
                    ]),
                ],*/
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipo::class,
        ]);
    }
}
