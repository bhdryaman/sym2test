<?php


namespace Yaman\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('content', 'text')
            ->add('status', 'number',array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)),
                ),
            ))
            ->add('tag', 'entity', array(
                'class' => 'Yaman\BlogBundle\Entity\Tag',
                'multiple' => true,
                'expanded' => true,
                'property' => 'name',
            ) )
            ->add('save', 'submit', array('label' => 'Create Post'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'      => 'Yaman\BlogBundle\Entity\Post',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'task_item',
        ));
    }

    public function getName()
    {
        return 'post';
    }
}