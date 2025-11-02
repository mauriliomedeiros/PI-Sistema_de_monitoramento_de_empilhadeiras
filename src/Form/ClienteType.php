<?php

namespace App\Form;

use App\Entity\Cliente\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('razao_social', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('nome_fantasia', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('cnpj', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('inscricaoEstadual', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('telefone', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('email', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('nomeResponsavel', TextType::class, [
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
            ->add('estado', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('cep', TextType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('dataCadastro', TextType::class, [
                'required' => true,
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
