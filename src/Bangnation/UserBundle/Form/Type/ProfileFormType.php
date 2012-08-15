<?php

namespace Bangnation\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Bangnation\UserBundle\Form\ProfileType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('birthDate', 'birthday', array(
                'widget' => 'choice',
                'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
                'format' => 'yyyy-MMM-dd',                
            ))
            ->add('profile', new ProfileType())
            ->add('turnOns', null, array(
                'label' => 'Turn Ons',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('turnOffs', null, array(
                'label' => 'Turn Offs',
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bangnation\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'bangnation_user_profile';
    }
}
