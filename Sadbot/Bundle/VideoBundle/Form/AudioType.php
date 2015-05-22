<?php

namespace Sadbot\Bundle\VideoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AudioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','iphp_file')
            ->add('title')
            ->add('description')
            ->add('status')
            ->add('status', 'choice', array(
                'choices' => array(true =>'public', false => 'private'),
                'attr' => array('class'=>'form-control')
            ))
            ->add('audioCategory')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Audio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sadbot_bundle_videobundle_audio';
    }
}
