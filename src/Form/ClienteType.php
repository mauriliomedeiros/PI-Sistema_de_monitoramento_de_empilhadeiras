<?php

namespace App\Form;

use App\Entity\Cliente\Cliente;
use Symfony\Component\Form\AbstractType;
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
                'label' => 'Razão Social: *',
            ])
            ->add('nome_fantasia', TextType::class, [
                'required' => true,
                'label' => 'Nome Fantasia: *',
            ])
            ->add('cnpj', TextType::class, [
                'required' => true,
                'label' => 'CNPJ: *',
            ])
            ->add('ativo');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
