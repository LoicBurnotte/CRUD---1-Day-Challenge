<?php

namespace CollectionBundle\Form;

use CollectionBundle\Entity\Car;
use CollectionBundle\Entity\Category;
use CollectionBundle\Entity\Garage;
use CollectionBundle\Repository\GarageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('mark', TextType::class, array(
            'attr' => array('autofocus' => true),
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Mark'
        ));
        $builder->add('model', TextType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Model'
        ));
        $builder->add('dateConstruction', BirthdayType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'format' => 'dd-MM-yyyy',
            'placeholder' => array(
                'day' => 'Day', 'month' => 'Month', 'year' => 'Year'
            ),
            'required' => true,
            'label' => 'Construction Date'
        ));
        $builder->add('picturePath', TextType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'required' => false,
            'label' => 'Picture\'s URL'
        ));
        $builder->add('price', IntegerType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Price'
        ));
        $builder->add('datePurchase', BirthdayType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'format' => 'dd-MM-yyyy',
            'placeholder' => array(
                'day' => 'Day', 'month' => 'Month', 'year' => 'Year'
            ),
            'required' => true,
            'label' => 'Purchase Date'
        ));
        $builder->add('serialNumber', TextType::class, array(
            'label_attr' => array('class' => 'custom-label'),
            'required' => false,
            'label' => 'Serial Number'
        ));
        $builder->add('category', EntityType::class, array(
            'class' => Category::class,
            'choice_label' => 'name',
            'required' => true,
            'label' => 'Category'
        ));
        $builder->add('garage', EntityType::class, array(
            'class' => Garage::class,
            'choice_label' => 'locate',
            'required' => true,
            'label' => 'Garage',
            'query_builder' => function(GarageRepository $repository){
                return $repository->getEnableGarageQb();
            }
        ));

        $builder->add('Submit', SubmitType::class, array(
            'attr' => array('class' => 'custom-submit'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Car::class);
    }

    public function getBlockPrefix()
    {
        return 'collection_car';
    }
}
