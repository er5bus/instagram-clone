<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullname', TextType::class, ['label' => 'full name']);
    }

    public function getparent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
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
