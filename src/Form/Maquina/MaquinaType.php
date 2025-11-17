<?php

namespace App\Form\Maquina;

use App\Entity\Maquina\Maquina;
use App\Entity\Maquina\Modelo;
use App\Repository\Maquina\ModeloRepository;
use App\Repository\ClienteRepository;
use App\Repository\LocalRepository;
use App\Entity\Local\Local;
use App\Entity\Cliente\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaquinaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao', TextType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('modelo', EntityType::class, [
                'class' => Modelo::class,
                'choice_label' => 'getNomeComFabricante',
                'label' => false,
                'placeholder' => '---Selecione---',
                'query_builder' => function (ModeloRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where('m.ativo = :ativo')
                        ->setParameter('ativo', true)
                        ->orderBy('m.nome', 'ASC');
                },
            ])
            ->add('serialNumber', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('local', EntityType::class, [
                'class' => Local::class,
                'choice_label' => 'getNomeComCliente',
                'label' => false,
                'placeholder' => '---Selecione---',
                'query_builder' => function (LocalRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.ativo = :ativo')
                        ->setParameter('ativo', true)
                        ->orderBy('l.nome', 'ASC');
                },
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
            'data_class' => Maquina::class,
        ]);
    }
}
