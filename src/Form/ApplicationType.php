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
            'placeholder' => $placeholder
        );

    }

    /**
     * Permet d'avoir la configuration de base d'un ajout de formulaire imbriqué
     *
     * @param string $label
     * @return array
     */
    protected function getConfigurationFormType(string $label, string $propertyPath): array
    {
        return array(
            'label' => $label,
            'mapped' => false,
            'required' => false,
            'property_path' => $propertyPath
        );

    }

    protected function setFormEvent(array $data, FormInterface $form, string $oldField, string $newField, string $class)
    {

        if (!empty($data[$newField]['id'])) {

            $form->remove($oldField);
            $form->add($newField,
                $class, [
                    'required' => true,
                    'mapped' => true,
                    'property_path' => $oldField
                ]);
        }

    }

}