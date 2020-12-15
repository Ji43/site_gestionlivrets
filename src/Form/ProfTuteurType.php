<?php

namespace App\Form;

use App\Entity\ProfTuteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfTuteurType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,
            $this->getConfiguration(
                "Nom","Renseignez le nom du professeur tuteur...")
            )
            ->add('prenom',TextType::class,
                $this->getConfiguration("Prénom","Renseignez le prénom du professeur tuteur...")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProfTuteur::class,
        ]);
    }
}
