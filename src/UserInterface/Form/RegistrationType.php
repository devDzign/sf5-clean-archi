<?php

namespace App\UserInterface\Form;

use App\Infrastructure\Validator\NonUniqueEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("firstName", TextType::class, [
                "label" => "Prénom :",
                "constraints" => [
                    new NotBlank()
                ]
            ])
            ->add("lastName", TextType::class, [
                "label" => "Nom :",
                "constraints" => [
                    new NotBlank()
                ]
            ])
            ->add("email", EmailType::class, [
                "label" => "Email :",
                "constraints" => [
                    new NotBlank(),
                    new Email(),
                    new NonUniqueEmail()
                ]
            ])

            ->add("plainPassword", RepeatedType::class, [
                "type" => PasswordType::class,
                "first_options" => [
                    "label" => "Mot de passe :"
                ],
                "second_options" => [
                    "label" => "Confirmez votre mot de passe :"
                ],
                "invalid_message" => "La confirmation doit être similaire au mot de passe",
                "constraints" => [
                    new NotBlank(),
                    new Length(["min" => 8])
                ]
            ])
        ;
    }
}
