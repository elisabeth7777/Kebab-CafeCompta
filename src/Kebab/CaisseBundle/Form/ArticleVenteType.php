<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kebab\CaisseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleVenteType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article', 'entity', array(
                'class'    => 'KebabCaisseBundle:Article',
                'property' => 'name',
                'multiple' => false,
                'expanded' => false
              ))
            ->add('montant', 'money', array())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\CaisseBundle\Entity\ArticleVente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_caissebundle_articlevente';
    }
}
