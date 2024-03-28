<?php

namespace App\Form;

use App\Entity\RicParticipant;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $ricDates = ['2024-04-23', '2024-04-30', '2024-05-07', '2024-05-21'];
        $today = new DateTimeImmutable();        
        $ricList = [];

        foreach($ricDates as $ric) {
            $date= new DateTimeImmutable($ric);
            if($date>$today) {
                $ricList[$date->format('d/m/Y')." à 15h00"] = $date->format('d/m/Y');
            }
        }

        if(empty($ricList)) {
            $ricList["Il n'y a plus de RIC de programmée"] = "pas de date";
        } else {
            $ricList["aucune date ne convient"] = "pas de date";
        }
        
        $builder            
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('mail', EmailType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'E-mail',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Ville de résidence',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Date de naissance',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('ricDate', ChoiceType::class, [
                    'choices' => $ricList,
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Date de la réunion choisie',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],

            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'required'=>false,
                'label' => 'message (optionnel)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RicParticipant::class,
        ]);
    }
}
