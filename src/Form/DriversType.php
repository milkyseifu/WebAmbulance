<?php

namespace App\Form;

use App\Entity\Ambulance;
use App\Entity\Drivers;
use App\Entity\Hospital;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriversType extends AbstractType
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
            ->add('Age', NumberType::class, [
                'label'=>'Age',
                'attr'=>[
                    'placeholder'=>'Enter Age',
                    'class'=>'form-control'
                ]
            ])
            ->add('Sex', ChoiceType::class, [
                'label'=>'Sex',
                'choices'=>[
                    'male'=>'M',
                    'Female'=>'F'
                ],
                'attr'=>[
                    'class'=>'form-control btn btn-sm btn-outline-primary dropdown-toggle'
                ]
            ])
            ->add('PhoneNumber', TextType::class, [
                'label'=>'Phone Number',
                'attr'=>[
                    'placeholder'=>'Enter Phone Number',
                    'class'=>'form-control'
                ]
            ])
            ->add('ambulance',EntityType::class,[
                'required'=>true,
                'class' => Ambulance::class,
                'choice_value' => 'id',
                'choice_label' => 'AmbulanceName',
                'attr'=>[
                    'class'=>'form-control btn btn-sm btn-outline-primary dropdown-toggle'
                ]
            ])
            ->add('username', TextType::class, [
                'label'=>'Ambulance Name',
                'attr'=>[
                    'placeholder'=>'Enter Ambulance Name',
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
            'data_class' => Drivers::class,
        ]);
    }
}
