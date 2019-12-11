<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entre un email']),
                    new Email(['message' => 'Veuillez rentrer une adresse valide'])
                ]
            ])
            // ->add('roles')
            // ->add('password')
            ->add('pseudo',TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'veuillez indiquer un pseudo']),
                    new Regex([
                        'pattern' => '/^[a-z0-9-_]+$/i',
                        'message' => 'Le pseudo ne peut contenir que des caracteres alphanumerique'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'le pseudo doit contenir au moins 3 caractères',
                        'max' => 40,
                        'maxMessage' => 'le pseudo ne peut contenir plus de 40 caracteres',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
