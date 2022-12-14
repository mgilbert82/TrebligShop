<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Quel nom souhaitez-vous donner à votre adresse ?',
                    'attr' => [
                        'placeholder' => 'Nommer votre adresse',
                    ],
                ]
            )
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Votre prénom',
                    'attr' => [
                        'placeholder' => 'Renseigner votre prénom',
                    ],
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'Votre nom',
                    'attr' => [
                        'placeholder' => 'Renseigner votre nom',
                    ],
                ]
            )
            ->add(
                'company',
                TextType::class,
                [
                    'label' => 'Nom de votre société',
                    'required' => false,
                    'attr' => [
                        'placeholder' => '(facultatif) Renseigner le nom de votre société',
                    ],
                ]
            )
            ->add(
                'address',
                TextType::class,
                [
                    'label' => 'Votre adresse',
                    'attr' => [
                        'placeholder' => '19 rue roger henry...',
                    ],
                ]
            )
            ->add(
                'postal',
                TextType::class,
                [
                    'label' => 'Votre code postal',
                    'attr' => [
                        'placeholder' => 'Renseigner votre code postal',
                    ],
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'Votre ville',
                    'attr' => [
                        'placeholder' => 'Renseigner votre ville',
                    ],
                ]
            )
            ->add(
                'country',
                CountryType::class,
                [
                    'label' => 'Votre pays',
                    'attr' => [
                        'placeholder' => 'Renseigner votre pays',
                        'class' => 'form-control'
                    ],
                ]
            )
            ->add(
                'phone',
                TelType::class,
                [
                    'label' => 'Votre téléphone',
                    'attr' => [
                        'placeholder' => 'Renseigner votre téléphone',
                    ],
                ]
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'mx-auto btn btn-info',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
