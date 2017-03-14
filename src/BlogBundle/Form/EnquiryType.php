<?php

namespace BlogBundle\Form;

use BlogBundle\Form\DataTransformer\SanitizeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnquiryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'attr' => [
                'placeholder' => 'Uw naam',
            ],
            'label' => 'Uw naam',
            'required' => true,
        ]);
        $builder->add('email', EmailType::class, [
            'attr' => [
                'placeholder' => 'mijnEmail@domein.nl',
            ],
            'label' => 'Uw email adres',
            'required' => true,
        ]);
        $builder->add('subject', TextType::class, [
            'attr' => [
                'placeholder' => '',
            ],
            'label' => 'Onderwerp',
            'required' => true,
        ]);
        $builder->add('body', TextareaType::class, [
            'label' => 'Uw bericht',
            'required' => true,
        ]);
        $builder->add('submit', SubmitType::class, [
            'label' => 'Versturen'
        ]);

        $builder->get('name')->addModelTransformer(new SanitizeTransformer());
        $builder->get('email')->addModelTransformer(new SanitizeTransformer());
        $builder->get('subject')->addModelTransformer(new SanitizeTransformer());
        $builder->get('body')->addModelTransformer(new SanitizeTransformer());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ]);
    }
}