<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('description', TextType::class)
                ->add('start', DateTimeType::class, array(
                    'widget' => 'single_text',
                    ))
                ->add('end', DateTimeType::class, array(
                    'widget' => 'single_text',
                    ))
                ->add('location', TextType::class)
                ->add('comment', TextType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Event',
            'allow_extra_fields' => true,
        ]);
    }

    public function getName() {
        return 'event';
    }

}
