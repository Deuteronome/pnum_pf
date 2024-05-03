<?php

namespace App\Form;

use App\Entity\RicParticipant;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('applicationType', ChoiceType::class , [
                'mapped' => false,
                'choices' => [
                    'Candidature spontanée' => 'en direct',
                    'Orienté par un structure' => 'prescrite'
                ],
                'attr' => [
                    'class' => 'form-control mb-2',
                ],
                'label' => 'Type de candidature',
                
            ])
            ->add('prescribingStructure', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2 d-none prescriber',
                    
                ],
                'label' => 'Structure prescriptrice',
                'label_attr'=> [
                    'class' => 'label-control d-none prescriber'
                ],
                'required' => false,                
            ])
            ->add('prescriber', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2 d-none prescriber',
                    
                ],
                'label' => 'Nom du conseiller',
                'label_attr'=> [
                    'class' => 'label-control d-none prescriber'
                ],
                'required' => false,                
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
            ->add('birthCity', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Lieu de naissance',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('schoolLevel', ChoiceType::class, [
                'choices' => [
                    'Classe primaire ou non scolarisé'=>'Classe primaire ou non scolarisé',
                    '6ème ou 5ème collège'=>'6ème ou 5ème collège',
                    '4ème ou 3ème collège'=>'4ème ou 3ème collège',
                    '3ème inachevée' => '3ème inachevée',
                    '1ère année de CAP/BEP'=>'1ère année de CAP/BEP',
                    'Dernière année de CAP/BEP'=> 'Dernière année de CAP/BEP',
                    '2nde ou 1ère lycée'=>'2nde ou 1ère lycée',
                    'Terminale (BAC ou BAC PRO)'=>'Terminale (BAC ou BAC PRO)',
                    'autre' => 'autre'
                ],
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Dernière classe fréquentée',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('grade', textType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Diplôme préparé',
                'required'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('is_got', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mb-4 mx-3'
                ],
                'label' => 'Diplôme obtenu',
                'required'=>false,
                
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
            ->add('adress', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Adresse',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),
                ],
            ])
            ->add('zipCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Code postal',
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
                'label' => 'Ville',
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
