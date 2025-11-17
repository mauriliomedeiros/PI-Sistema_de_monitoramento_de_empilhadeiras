<?php

namespace App\Form\Checklist;

use App\Entity\Checklist\Checklist;
use App\Entity\Core\Usuario;
use App\Entity\Maquina\Maquina;
use App\Repository\Core\UsuarioRepository;
use App\Repository\Maquina\MaquinaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChecklistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $usuarioLogado = $options['usuario_logado'];
        dump($usuarioLogado);

        $builder
            ->add('nome', TextType::class, [
                'label' => false,
                'attr' => [
                    'maxlength' => 255,
                ]
            ])
            ->add('operador', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => function ($usuario) {
                    return $usuario->getNome() .' (' . $usuario->getUsername() . ')';
                },
                'label' => false,
                'placeholder' => '---Selecione---',
                'query_builder' => function (UsuarioRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.ativo = :ativo')
                        ->setParameter('ativo', true)
                        ->orderBy('u.id', 'ASC');
                },
                'mapped' => false,
                'data' => $usuarioLogado,
                'disabled' => true
            ])
            ->add('observacoesComplementaresDeSeguranca', TextareaType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('nivelOleoMotor', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('nivelOleoTransmissao', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('nivelOleoHidraulico', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('nivelAguaRadiador', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('vazamentoOleo', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('vazamentoGLP', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('nivelOleoFreio', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('buzinaSinalizadorSonoro', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('faroisLanternasGiroflex', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('retrovisor', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('pneus', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('freio', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('freioDeMao', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('sistemaDeDirecao', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('garfosCorrenteDaTorre', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('extintorDeIncendio', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('cintoDeSegurancaEBanco', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('instrumentosDoPainel', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('funcionamentoMotor', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('pinturaECarenagens', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('limpezaGeralExterna', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Selecione--',
                'choices' => [
                    'OK' => 'OK',
                    'NOK' => 'NOK',
                ]
            ])
            ->add('maquina', EntityType::class, [
                'class' => Maquina::class,
                'choice_label' => function ($maquina) {
                    return $maquina->getModelo()->getNome().' (ID '.$maquina->getId().')';
                },
                'label' => false,
                'placeholder' => '---Selecione---',
                'query_builder' => function (MaquinaRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where('m.ativo = :ativo')
                        ->setParameter('ativo', true)
                        ->orderBy('m.id', 'ASC');
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
            'data_class' => Checklist::class,
            'usuario_logado' => null,
        ]);
    }
}
