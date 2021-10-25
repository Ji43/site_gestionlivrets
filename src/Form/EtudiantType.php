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
                    'Nom',
                    'Renseignez le nom de l\'étudiant...'
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
                        'widget' => 'choice',
                        'years' => range('1970','2005')
                    )))
            ->add('classe',
                EntityType::class,
                $this->getConfigurationEntityType(
                    Classe::class, "Classe", "nomClasse", "Sélectionner une classe..."
                )
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
