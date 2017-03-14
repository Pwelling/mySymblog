<?php

namespace BlogBundle\Form;

use BlogBundle\Form\DataTransformer\SanitizeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', TextType::class, [
                'attr' => [
                    'placeholder' => 'Uw naam',
                ],
                'label' => 'Uw naam',
                'required' => true,
            ])
            ->add('comment', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Uw opmerking',
                ],
                'label' => 'Uw opmerking',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Plaatsen',
            ]);

        $builder->get('user')->addModelTransformer(new SanitizeTransformer());
        $builder->get('comment')->addModelTransformer(new SanitizeTransformer());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'BlogBundle_commentType';
    }
}
