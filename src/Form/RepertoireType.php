<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Repertoire;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RepertoireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('titre', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
                ])    
            ->add('ville', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('departement', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
                ])
            ->add('pays', TextType::class, [
                'attr' => ['class' => 'form-control']
                ])
            ->add('annee', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('photos', CollectionType::class, [
                'entry_type' => PhotoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'required' => false,
                'by_reference' => false,
                'prototype' => true,
                // 'prototype_name' => '__name2__',
                'label' => false,
               
            ])
            ->add('tags',CollectionType::class, [
                'entry_type' => TagType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'required' => false,
                'by_reference' => false,
                'prototype' => true,
                'label' => false,
                
            ])           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Repertoire::class,
        ]);
    }
}

