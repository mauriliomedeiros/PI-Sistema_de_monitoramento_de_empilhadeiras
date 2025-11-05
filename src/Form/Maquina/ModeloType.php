<?php

namespace App\Form\Maquina;

use App\Entity\Maquina\Fabricante;
use App\Entity\Maquina\Modelo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fabricante', EntityType::class, [
                'class' => Fabricante::class,
                'choice_label' => 'nome',
                'label' => false,
                'placeholder' => '---Selecione---',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->where('f.ativo = :ativo')
                        ->setParameter('ativo', true)
                        ->orderBy('f.nome', 'ASC');
                },
            ])
            ->add('nome', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('cargaTotal', TextType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('caracteristicas', TextareaType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('aplicacoes', TextareaType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('ativo', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'Sim' => true,
                    'Não' => false,
                ],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modelo::class,
        ]);
    }
}
