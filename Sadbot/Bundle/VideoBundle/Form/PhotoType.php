<?php

namespace Sadbot\Bundle\VideoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhotoType extends AbstractType
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
            ->add('status', 'choice', array(
                'choices' => array(true =>'public', false => 'private'),
                'attr' => array('class'=>'form-control')
            ))
            ->add('photoCategory','entity',
                array(
                    'class' => 'Sadbot\Bundle\VideoBundle\Entity\PhotoCategory',
                    'label' => 'form.category.photo',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Photo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sadbot_bundle_videobundle_photo';
    }
}
