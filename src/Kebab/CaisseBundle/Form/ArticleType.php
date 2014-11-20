<?php

namespace Kebab\CaisseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeCpte')    
            ->add('nom')
            ->add('taxes', null, array(
                  'label' => "Taux de la Taxe"
            ))    
            ->add('type', 'choice', array(
                  'choices' => array('1' => 'H.T', '0' => 'T.T.C'),
                  'preferred_choices' => array('TTC'),
                  'multiple'  => false,
                  'expanded'  => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\CaisseBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_caissebundle_article';
    }
}
