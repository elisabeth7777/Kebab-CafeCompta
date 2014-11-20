<?php

namespace Kebab\ComptaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kebab\ComptaBundle\Entity\IncompleteDateTransformer;

class SalaireType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date', array(
                    'widget' => 'choice',
                    'years' => range(date('Y'), date('Y') - 10),
))
//                ->addViewTransformer(new IncompleteDateTransformer())
            ->add('salarie')
            ->add('salaireNet')
            ->add('avances')
            ->add('salaireBase')
            ->add('repasAvantage')
            ->add('absences');     
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kebab\ComptaBundle\Entity\Salaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kebab_comptabundle_salaire';
    }
}
