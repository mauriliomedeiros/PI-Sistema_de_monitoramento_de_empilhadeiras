<?php

namespace App\Form\Core;

use App\Entity\Core\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => false
            ])
            ->add('sobrenome', TextType::class, [
                'label' => false
            ])
            ->add('username', TextType::class, [
                'label' => false
            ])
            ->add('password', PasswordType::class, [
                'label' => false
            ])
            ->add('role', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'Administrador' => 'ROLE_ADMIN',
                    'Usuário' => 'ROLE_USER',
                ],
                'required' => true
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
            'data_class' => Usuario::class,
        ]);
    }
}
