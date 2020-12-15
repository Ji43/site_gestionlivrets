<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\MaitreStage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaitreStageType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
                TextType::class,
                $this->getConfiguration(
                    'Nom',
                    'Renseignez le Nom du maître de stage...'
                ))
            ->add('prenom',
                TextType::class,
                $this->getConfiguration(
                    'Prénom',
                    'Renseignez le prénom du maître de stage...'
                ))
            ->add('entreprise',
                EntityType::class,
                $this->getConfigurationEntityType(Entreprise::class, "Sélectionnez une entreprise",
                    "nom", "Lier une entreprise à ce maître de stage...")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaitreStage::class,
        ]);
    }
}
