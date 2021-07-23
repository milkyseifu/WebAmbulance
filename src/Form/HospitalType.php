<?php

namespace App\Form;

use App\Entity\Hospital;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HospitalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('HospitalName', TextType::class, [
                'label'=>'Hospital Name',
                'attr'=>[
                    'placeholder'=>'Enter Hospital',
                    'class'=>'form-control'
                ]
            ])
            ->add('Address', TextType::class, [
                'label'=>'Address',
                'attr'=>[
                    'placeholder'=>'Enter Address',
                    'class'=>'form-control'
                ]
            ])
            ->add('Capacity', NumberType::class, [
                'label'=>'Capacity',
                'attr'=>[
                    'placeholder'=>'Enter Capacity',
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hospital::class,
        ]);
    }
}
