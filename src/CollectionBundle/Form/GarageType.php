<?php

namespace CollectionBundle\Form;

use CollectionBundle\Entity\Garage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('locate', TextType::class, array(
            'attr' => array('autofocus' => true),
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Locate'
        ));
        $builder->add('number', IntegerType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Number'
        ));
        $builder->add('capacity', IntegerType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Max Capacity'
        ));

        $builder->add('Submit', SubmitType::class, array(
            'attr' => array('class' => 'custom-submit'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Garage::class);
    }

    public function getBlockPrefix()
    {
        return 'collection_garage';
    }
}
