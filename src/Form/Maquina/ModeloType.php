<?php

namespace App\Form\Maquina;

use App\Entity\Maquina\Modelo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('cargaTotal')
            ->add('caracteristicas')
            ->add('aplicacoes')
            ->add('ativo')
            ->add('fabricante')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modelo::class,
        ]);
    }
}
