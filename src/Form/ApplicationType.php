<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;

class ApplicationType extends AbstractType
{
    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfiguration($label, $placeholder, $options = [])
    {
        return array_merge_recursive([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }

    /**
     * Permet d'avoir la configuration de base d'un ajout de champ type EntityType
     *
     * @param string $class
     * @param $label
     * @param $choiceLabel
     * @param $placeholder
     * @return array
     */
    protected function getConfigurationEntityType(string $class, string $label, string $choiceLabel, string $placeholder)
    {

        return array(
            'class' => $class,
            'label' => $label,
            'choice_label' => $choiceLabel,
            'placeholder' => $placeholder,
            'required' => false
        );

    }

    /**
     * Permet d'avoir la configuration de base d'un ajout de formulaire imbriqué
     *
     * @param string $label
     * @return array
     */
    protected function getConfigurationFormType(string $label): array
    {
        return array(
            'label' => $label,
            'mapped' => false,
            'required' => false,
        );

    }

    /**
     * Permet de vérifier qu'il s'agisse bien d'un ajout nouveau et si c'est le cas on
     * l'enregistre en le bindant au champ de l'entité
     *
     * @param array $data
     * @param FormInterface $form
     * @param string $selectField
     * @param string $newField
     * @param string $class
     */
    protected function setFormEvent(array $data, FormInterface $form, string $selectField, string $newField, string $class)
    {

        if ( empty($data[$selectField]) && !empty($data[$newField]['id']) ) {

            $form->remove($newField);
            $form->add($newField,
                $class, [
                    'property_path' => $selectField
                ]);
        }

    }

}