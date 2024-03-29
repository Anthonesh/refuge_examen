<?php

namespace App\Form;

use App\Entity\Pensionnaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PensionnairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_pensionnaire')
            ->add('type_pensionnaire')
            ->add('date_de_naissance_pensionnaire', DateType::class, [
                    'years' => range(date('Y') - 50, date('Y'))
            ])
            ->add('image_pensionnaire', FileType::class, [ 
                'label' => 'Image du pensionnaire',
                'mapped' => false, 
                'required' => false, 
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image au format JPEG, PNG ou GIF.',
                    ]),
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pensionnaires::class,
        ]);
    }
}
