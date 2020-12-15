<?php

namespace App\Form;

use App\Entity\Periode;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeriodeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee1',
                TextType::class,
                $this->getConfiguration("Année de début", "Renseignez l'année de début...")
            )
            ->add('annee2', TextType::class,
                $this->getConfiguration("Année de fin", "Renseignez l'année de fin...")
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Periode::class,
        ]);
    }
}
