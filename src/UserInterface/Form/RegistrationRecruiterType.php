<?php

namespace App\UserInterface\Form;

use App\UserInterface\DataTransferObject\RegistrationRecruiterDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationRecruiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("companyName", TextType::class, [
                "label" => "Nom de la companie :",
                "constraints" => [
                    new NotBlank()
                ]
            ])

        ;
    }

    /**
     * @return string|null
     */
    public function getParent()
    {
        return RegistrationType::class;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", RegistrationRecruiterDTO::class);
    }
}
