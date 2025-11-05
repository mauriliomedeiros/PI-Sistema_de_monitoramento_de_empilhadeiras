<?php

namespace App\Form;

use App\Entity\Cliente\Cliente;
use App\Entity\Local\Local;
use App\Entity\Maquina\ListaEmpilhadeira;
use App\Entity\Maquina\Modelo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaEmpilhadeiraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modelo', EntityType::class, [
                'class' => Modelo::class,
                'choice_label' => 'modelo',
                'label' => 'Modelo:*',
                'placeholder' => '---Selecione---',
            ])
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class,
                'choice_label' => 'razao_social',
                'label' => 'Cliente:*',
                'placeholder' => '---Selecione---',
            ])
            ->add('local', EntityType::class, [
                'class' => Local::class,
                'choice_label' => 'nome',
                'label' => 'Local:*',
                'placeholder' => '---Selecione---',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListaEmpilhadeira::class,
        ]);
    }
}
