<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Actor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('summary')
            ->add('poster')
            ->add('category', null, ['choice_label' => 'name'])
            ->add('actors', EntityType::class, [
                'class' => Actor::class,
                'choice_label' => 'selector',
                'multiple' => true,
                'expanded' => true ,
                'by_reference' => false,
            ])
            ->add('posterFile', VichFileType::class, [
                'label' => 'Télécharger un poster',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'delete_label' => 'Supprimer le poster ?',
                'download_uri'  => true, // not mandatory, default is true
                'download_label' => 'Télécharger le fichier',
            ])
            ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
