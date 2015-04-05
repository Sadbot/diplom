<?php

namespace Sadbot\Bundle\VideoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ThumbnailUploadType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file',array(
                'attr'=>array('class'=>'')
            ))
            ->add('save','submit', array(
                'attr'=> array('class'=> 'btn btn-default')
            ))
            ->getForm();
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'thumbnailupload';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sadbot\Bundle\VideoBundle\Entity\Thumbs',
        ));
    }
}