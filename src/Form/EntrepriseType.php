<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
                TextType::class,
                $this->getConfiguration(
                    'Libellé',
                    'Renseignez le libellé de l\'entreprise...'
                ))
            ->add('adresse',
            TextType::class,
                $this->getConfiguration(
                 'Adresse',
                 'Renseignez l\'adresse de l\'entreprise...'
                ))
            ->add('tel',
            TextType::class,
                $this->getConfiguration(
                 'Numéro de téléphone',
                 'Renseignez le numéro de téléphone de l\'entreprise...'
                ))
            ->add('mail',
            TextType::class,
                $this->getConfiguration(
                    'Adresse email',
                    'Renseignez l\'adresse email de l\'entreprise...'
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
