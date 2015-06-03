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
            ->add('file','iphp_file', array(
                'label' => 'form.file',
            ))
            ->add('title','text',
                array(
                    'label' => 'form.title',
                ))
            ->add('description','text',
                array(
                    'label' => 'form.description',
                ))
            ->add('status', 'choice', array(
                'choices' => array(
                    true =>'form.status.public',
                    false => 'form.status.private'
                ),
                'attr' => array('class'=>'form-control'),
                'label' => 'form.status.label',
            ))
            ->add('audioCategory','entity',
                array(
                    'class' => 'Sadbot\Bundle\VideoBundle\Entity\AudioCategory',
                    'label' => 'form.category.audio',
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Audio',
            'translation_domain' => 'VideoBundle'
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
