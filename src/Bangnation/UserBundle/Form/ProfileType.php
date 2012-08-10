<?php

namespace Bangnation\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bodyHair')
            ->add('position', 'choice', array(
                'choices' => array(
                    "top" => "Top", 
                    "bottom" => "Bottom", 
                    "versatile" => "Versatile", 
                    "versatile/top" => "Versatile/Top", 
                    "versatile/bottom" => "Versatile/Bottom",
                ),
                'required' => false,
            ))
            ->add('race')
            ->add('hivStatus', 'choice', array(
                'choices' => array(
                    'pos' => 'Poz', 
                    'neg' => 'Neg', 
                    "don't care" => "Don't Care", 
                    'unknown' => "Unknown",
                ),
                'required' => false,
            ))
            ->add('smokingStatus')
            ->add('whereMeet', 'choice', array(
                'choices' => array(
                    'my place' => 'My Place', 
                    'public' => 'Public',
                    'your place' => 'Your Place',
                    'hotel' => 'Hotel',
                ),
                'required' => false,
            ))
            ->add('whenMeet', 'choice', array(
                'choices' => array(
                    'right now' => 'Right Now', 
                    "weekend, let's plan it." => "Weekend, Let's Plan It",
                    'after work' => 'After Work',
                ),
                'required' => false,
            ))
            ->add('lookingFor', 'choice', array(
                'choices' => array(
                    'friendship' => 'Friendship',
                    'relationship' => 'Relationship',
                    '1-on-1 sex' => '1-on-1 Sex',
                    '3some/group sex' => '3some/Group Sex',
                ),
                'required' => false,
            ))
            ->add('drink')
            ->add('smoke')
            ->add('practice', 'choice', array(
                'choices' => array(
                    'safe only' => 'Safe Only',
                    'bareback only' => 'Bareback Only',
                    'sometimes safe' => 'Sometimes Safe',
                    'anything goes' => 'Anything goes',
                ),
            ))
            ->add('tattoos')
            ->add('piercings')
            ->add('cockSize')
            ->add('circumcised')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bangnation\UserBundle\Entity\Profile'
        ));
    }

    public function getName()
    {
        return 'bangnation_userbundle_profiletype';
    }
}
