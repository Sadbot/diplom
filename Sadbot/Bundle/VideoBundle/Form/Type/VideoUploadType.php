<?php

namespace Sadbot\Bundle\VideoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class VideoUploadType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file',array(
                'attr'=>array('class'=>'')
            ))
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
            ->getForm();
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Video',
        ));
    }

    public function getName()
    {
        return 'fileupload';
    }

}