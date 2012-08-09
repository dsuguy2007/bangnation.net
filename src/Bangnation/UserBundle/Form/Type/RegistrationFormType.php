<?php

namespace Bangnation\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add('birthDate', 'birthday', array(
                'widget' => 'choice',
            ))
        ; 
    }

    public function getName()
    {
        return 'bangnation_user_registration';
    }
}