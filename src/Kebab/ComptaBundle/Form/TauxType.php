<?php

namespace Kebab\ComptaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TauxType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'choices' => array(
                    'PAT' => 'Part Patronale',
                    'SAL' => 'Part Salariale'
                ),
                'multiple' => false,
                'expanded' => false,
            )) 
            ->add('annee', 'date', array(
                                'widget' => 'choice',
                                'years' => range(date('Y'), date('Y') - 10),
            ))
            ->add('URSAFFDEPL', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('URSAFFPLFD', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('URSAFFFNAL', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('CSG', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('RDS', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('LODEOM', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('FILLON', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('cHOMAGE', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('aGS', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('rETN_CADRE', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('aGFFN_CADRE', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('tAXEAPPR', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            ->add('tAXEPROF', 'percent', array(
                'type'=> 'integer',
                'precision'=> 2
            ))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\ComptaBundle\Entity\Taux'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_comptabundle_taux';
    }
}
