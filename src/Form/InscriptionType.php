<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => function(Formation $formation) {
                    return sprintf(
                        "%s - %s (Prix : %d FCFA)",
                        $formation->getNom(),
                        $formation->getDescription(),
                        $formation->getPrix()
                    );
                },
                'expanded' => true,   // affichage sous forme de boutons radio
                'multiple' => false,  // un seul choix possible
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
