<?php

namespace Kebab\ComptaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SalarieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                    'choices'=> array (
                        'PRO' => 'Contrat Pro',
                        'NOR' => 'Contrat Normal'
                    ),
                    'multiple' => false,
                    'expanded' => true,
                ))                
            ->add('nom')
            ->add('prenom')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\ComptaBundle\Entity\Salarie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_comptabundle_salarie';
    }
}
