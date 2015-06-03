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
            ->setAttribute('class','fileupload')
            ->add('video','iphp_file',array(
                'attr'=>array(
                    'class' => 'fileupload',
                    'full_name' => 'file_upload'
                )
            ))
            ->add('image','iphp_file',array(
                'attr'=>array(
                    'class' => 'fileupload',
                    'full_name' => 'file_upload'
                )
            ))
            ->add('title','text',array(
                'label' => 'form.title'
            ))
            ->add('description','textarea',array(
                'attr'=> array('class'=> 'form-control'),
                'label' => 'form.description'
            ))
            ->add('status', 'choice', array(
                'choices' => array(true =>'public', false => 'private'),
                'attr' => array('class'=>'form-control'),
                'label' => 'form.status.label'
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
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Video',
            'translation_domain' => 'VideoBundle'
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
