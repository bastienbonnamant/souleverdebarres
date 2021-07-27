<?php

namespace App\Form;

use App\Entity\Gym;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GymType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Ville'
                )
                ),)
            ->add('name', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Nom de la salle'
                )
                ),)
            ->add('adress', TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'Adresse'
                )
                ),)
            ->add('number', NumberType::class, array(
                'attr' => array(
                    'placeholder' => 'Numéro de téléphone'
                )
                ),)
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'placeholder' => 'email'
                )
                ),)
            ->add('label', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Label'
                )
                ),)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gym::class,
        ]);
    }
}
