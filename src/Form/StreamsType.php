<?php

namespace App\Form;

use App\Entity\jeu;
use App\Entity\Streams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('StartDate', null, [
                'widget' => 'single_text',
            ])
            ->add('url')
            ->add('jeu', EntityType::class, [
                'class' => jeu::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Streams::class,
        ]);
    }
}
