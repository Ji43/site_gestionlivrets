<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends ApplicationType
{
    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
            TextType::class,
            $this->getConfiguration(
             'Nom de famille',
            'Renseignez le nom de famille de l\'étudiant...'
                ))

            ->add('prenom',
            TextType::class,
            $this->getConfiguration(
             'Prénom',
            'Renseignez le prénom de l\'étudiant...'
            ))

            ->add('mail',
            EmailType::class,
            $this->getConfiguration(
             'Adresse email',
             'Renseignez l\'adresse email de l\'étudiant...'
            ))

            ->add('dateNaissance',
            DateType::class,
             $this->getConfiguration(
             'Date de naissance',
             'Renseignez la date de naissance de l\'étudiant...',
                 array(
                  'widget' => 'choice'
                 )))

            ->add('classe',
            EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'nomClasse',
                'label' => 'Classe'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
