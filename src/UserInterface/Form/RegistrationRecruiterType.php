<?php

namespace App\UserInterface\Form;

use App\UserInterface\DataTransferObject\RegistrationRecruiterDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationRecruiterType extends RegistrationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add(
            "companyName",
            TextType::class,
            [
                "label"       => "Raison sociale",
                "constraints" => [
                    new NotBlank(),
                ],
            ]
        );
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", RegistrationRecruiterDTO::class);
    }
}
