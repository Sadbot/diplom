<?php

namespace Sadbot\Bundle\VideoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file')
            ->add('title','text')
            ->add('description','textarea',array(
                'attr'=> array('class'=> 'form-control')
            ))
            ->add('status', 'choice', array(
                'choices' => array(true =>'public', false => 'private'),
                'attr' => array('class'=>'form-control')
            ))
            ->add('save','submit', array(
                'attr'=> array('class'=> 'btn btn-default')
            ))
            ->add('tags')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Video'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sadbot_bundle_videobundle_video';
    }
}
