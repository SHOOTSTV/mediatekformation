<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Niveau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('publishedAt', null, [
                'label' => 'Date de création :'
            ])
            ->add('title', null, [
                'label' => 'Titre :'
            ])
            ->add('description', null, [
                'label' => 'Description :'
            ])
            ->add('miniature')
            ->add('picture', null, [
                'label' => 'Photo'
            ])
            ->add('videoId')
            ->add('niveau', EntityType::class, [
                'class' => Niveau::class,
                'choice_label' => 'niveau',
                'multiple' => false,
                'required' => false,
                'label' => 'Niveau :'
            ])            
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}