<?php

namespace CollectionBundle\Form;

use CollectionBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'attr' => array('autofocus' => true),
            'label_attr' => array('class' => 'custom-label'),
            'required' => true,
            'label' => 'Category Name'
        ));

        $builder->add('Submit', SubmitType::class, array(
            'attr' => array('class' => 'custom-submit'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Category::class);
    }

    public function getBlockPrefix()
    {
        return 'collection_category';
    }
}
