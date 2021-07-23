<?php

namespace App\Form;

use App\Entity\Patients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName', TextType::class, [
                'label'=>'First Name',
                'attr'=>[
                    'placeholder'=>'Enter First Name',
                    'class'=>'form-control'
                ]
            ])
            ->add('LastName', TextType::class, [
                'label'=>'Last Name',
                'attr'=>[
                    'placeholder'=>'Enter Last Name',
                    'class'=>'form-control'
                ]
            ])
            ->add('username', TextType::class, [
                'label'=>'Username',
                'attr'=>[
                    'placeholder'=>'Enter Username',
                    'class'=>'form-control'
                ]
            ])
            ->add('phoneNumber', NumberType::class, [
                'label'=>'Phone Number',
                'attr'=>[
                    'placeholder'=>'Enter Phone Number',
                    'class'=>'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label'=>'Password',
                'attr'=>[
                    'placeholder'=>'Enter Password',
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patients::class,
        ]);
    }
}
