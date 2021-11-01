<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Formation;
use App\Entity\Livret;
use App\Entity\MaitreApprentissage;
use App\Entity\Periode;
use App\Entity\ProfTuteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivretFormType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('etudiant', EntityType::class,
                $this->getConfigurationEntityType(
                    Etudiant::class, "Choix d'un étudiant", "fullname",
                    "Sélectionner un étudiant...")
            )
            ->add('nouveauEtudiant', EtudiantType::class,
                $this->getConfigurationFormType(
                    "Ajouter un étudiant")
            )
            ->add('formation', EntityType::class,
                $this->getConfigurationEntityType(Formation::class, "Choix d'une formation",
                    "libelle", "Sélectionner d'une formation..")
            )
            ->add('nouvelleFormation', FormationType::class,
                $this->getConfigurationFormType("Ajouter une formation")
            )
            ->add('maitreApprentissage', EntityType::class,
                $this->getConfigurationEntityType(MaitreApprentissage::class, "Choix d'un maître d'apprentissage",
                    "fullName", "Sélectionner un maître d'apprentissage...")
            )
            ->add('nouveauMaitreApprentissage', MaitreApprentissageType::class,
                $this->getConfigurationFormType("Ajouter un maître d'apprentissage")
            )
            ->add('profTuteur', EntityType::class,
                $this->getConfigurationEntityType(
                    ProfTuteur::class, "Choix d'un professeur tuteur", "fullName",
                    "Sélectionner un professeur tuteur..."
                )
            )
            ->add('nouveauProfTuteur', ProfTuteurType::class,
                $this->getConfigurationFormType("Ajouter un professeur tuteur")
            )
            ->add('periode', EntityType::class,
                $this->getConfigurationEntityType(
                    Periode::class, "Choix d'une période",
                    "annees", "Sélectionner une période de .. à .."
                )
            )
            ->add('nouvellePeriode', PeriodeType::class,
                $this->getConfigurationFormType("Ajouter une période")
            )
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            $this->setFormEvent($data, $form, "etudiant", "nouveauEtudiant", "nom", EtudiantType::class);
            $this->setFormEvent($data, $form, "formation", "nouvelleFormation", "libelle", FormationType::class);
            $this->setFormEvent($data, $form, "maitreApprentissage", "nouveauMaitreApprentissage", 'nom', MaitreApprentissageType::class);
            $this->setFormEvent($data, $form, "profTuteur", "nouveauProfTuteur", 'nom', ProfTuteurType::class);
            $this->setFormEvent($data, $form, "periode", "nouvellePeriode", 'annee1', PeriodeType::class);
        });
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livret::class,
        ]);
    }
}
