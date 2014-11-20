<?php

namespace Kebab\CaisseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VenteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',))
            ->add('articleventes', 'collection', array(
                  'type'         => new ArticleVenteType(),
                  'allow_add'    => true,
//                  'allow_delete' => true
              )) 
//            ->add('especes', 'money', array())
            ->add('cB', 'money', array())
            ->add('cH', 'money', array())                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\CaisseBundle\Entity\Vente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_caissebundle_vente';
    }
}
