<?php

namespace App\Form;

use App\Entity\Ambulance;
use App\Entity\Hospital;
use App\Entity\ServiceCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AmbulanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('AmbulanceName', TextType::class, [
                'label'=>'Ambulance Name',
                'attr'=>[
                    'placeholder'=>'Enter Ambulance Name',
                    'class'=>'form-control'
                ]
            ])
            ->add('PlateNumber', TextType::class, [
                'label'=>'Plate Number',
                'attr'=>[
                    'placeholder'=>'Enter Plate Number',
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
            ->add('Address', TextType::class, [
                'label'=>'Address',
                'attr'=>[
                    'placeholder'=>'Enter Address',
                    'class'=>'form-control'
                ]
            ])
            ->add('hospital',EntityType::class,[
                'required'=>true,
                'class' => Hospital::class,
                'choice_value' => 'id',
                'choice_label' => 'HospitalName',
                'attr'=>[
                    'class'=>'form-control btn btn-sm btn-outline-primary dropdown-toggle'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ambulance::class,
        ]);
    }
}
