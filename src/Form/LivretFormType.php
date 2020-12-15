<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Formation;
use App\Entity\Livret;
use App\Entity\MaitreStage;
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
                    "Ajouter un étudiant", "etudiant")
            )
            ->add('formation', EntityType::class,
                $this->getConfigurationEntityType(Formation::class, "Choix d'une formation",
                    "libelle", "Sélectionner d'une formation..")
            )
            ->add('nouvelleFormation', FormationType::class,
                $this->getConfigurationFormType("Ajouter une formation", "formation")
            )
            ->add('maitreStage', EntityType::class,
                $this->getConfigurationEntityType(MaitreStage::class, "Choix d'un maître de stage",
                    "fullName", "Sélectionner un maître de stage...")
            )
            ->add('nouveauMaitreStage', MaitreStageType::class,
                $this->getConfigurationFormType("Ajouter un maître de stage", "maitreStage")
            )
            ->add('profTuteur', EntityType::class,
                $this->getConfigurationEntityType(
                    ProfTuteur::class, "Choix d'un professeur tuteur", "fullName",
                    "Sélectionner un professeur tuteur..."
                )
            )
            ->add('nouveauProfTuteur', ProfTuteurType::class,
                $this->getConfigurationFormType("Ajouter un professeur tuteur", "profTuteur")
            )
            ->add('periode', EntityType::class,
                $this->getConfigurationEntityType(
                    Periode::class, "Choix d'une période",
                    "annees", "Sélectionner une période de .. à .."
                )
            )
            ->add('nouvellePeriode', PeriodeType::class,
                $this->getConfigurationFormType("Ajouter une période", "periode")
            )
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {

            $data = $event->getData();
            $form = $event->getForm();

            $this->setFormEvent($data, $form, "etudiant", "nouveauEtudiant", EtudiantType::class);
            $this->setFormEvent($data, $form, "formation", "nouvelleFormation", FormationType::class);
            $this->setFormEvent($data, $form, "maitreStage", "nouveauMaitreStage", MaitreStageType::class);
            $this->setFormEvent($data, $form, "profTuteur", "nouveauProfTuteur", ProfTuteurType::class);
            $this->setFormEvent($data, $form, "periode", "nouvellePeriode", PeriodeType::class);


//            if (!empty($data['nouveauEtudiant']['id'])) {
//
//                $form->remove('etudiant');
//                $form->add('nouveauEtudiant',
//                    EtudiantType::class, [
//                        'required' => true,
//                        'mapped' => true,
//                        'property_path' => 'etudiant'
//                    ]);
//            }

//            if (!empty($data['nouvelleFormation']['id'])) {
//                $form->remove('formation');
//                $form->add('nouvelleFormation',
//                    FormationType::class, [
//                        'required' => true,
//                        'mapped' => true,
//                        'property_path' => "formation"
//                    ]);
//            }

//            if (!empty($data['nouveauMaitreStage']['id'])) {
//                $form->remove('maitreStage');
//                $form->add('nouveauMaitreStage',
//                    MaitreStageType::class, [
//                        'required' => true,
//                        'mapped' => true,
//                        'property_path' => "maitreStage"
//                    ]);
//            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livret::class,
        ]);
    }
}
