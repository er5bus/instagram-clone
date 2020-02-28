<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('files', FileType::class, [
                'label' => 'Files',
                'attr' => ["class" => "custom-file-container__custom-file__custom-file-input", "accept"=>"image/*", "multiple"=>true, "aria-label"=> "Choose File"],
                'mapped' => false,
                'required' => false,
                'multiple' => true
            ])
            ->add('description', TextareaType::class, ['label' => 'Vibes' ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
