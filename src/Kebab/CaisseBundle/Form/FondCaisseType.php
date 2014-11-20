<?php

namespace Kebab\CaisseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FondCaisseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('solde')
            ->add('achats')
            ->add('versements')
            ->add('vente')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\CaisseBundle\Entity\FondCaisse'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_caissebundle_fondcaisse';
    }
}
