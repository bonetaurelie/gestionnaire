<?php

namespace AB\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('auteur')
            ->add('prix')
            ->add('quantiteDispo')
            ->add('save','submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */

    public function getName()
    {
        return 'ab_platformbundle_book_ajout';
    }

    public function getParent()
    {
        return new BookType();
    }
}