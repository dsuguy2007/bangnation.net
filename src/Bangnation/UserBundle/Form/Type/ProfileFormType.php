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
            ->add('birthDate')
            ->add('turnOns')
            ->add('turnOffs')
            ->add('profile', new ProfileType())
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
