<?php

namespace App\Form;

use App\Entity\Cliente\Cliente;
use App\Entity\Local\Estado;
use App\Entity\Local\Local;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('endereco', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('cidade', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('estado', EntityType::class, [
                'label' => false,
                'class' => Estado::class,
                'required' => true,
                'placeholder' => '---Selecione---',
            ])
            ->add('cep', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('observacao', TextType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class,
                'choice_label' => 'razao_social',
                'label' => false,
                'placeholder' => '---Selecione---',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.ativo = :ativo')
                        ->setParameter('ativo', true)
                        ->orderBy('c.razao_social', 'ASC');
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
            'data_class' => Local::class,
        ]);
    }
}
