<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ProfileFormType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('fullname', TextType::class, ['label' => 'Name'])
        ->add('about', TextareaType::class, ['label' => 'Bio'])
      ;
    }

    public function getparent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getblockprefix()
    {
        return 'app_user_registration';
    }

    // for symfony 2.x
    public function getname()
    {
        return $this->getblockprefix();
    }
}
