<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FrenchToDateTimeTransformer implements DataTransformerInterface {

    /**
     * Transforme un datetime en date française
     */
    public function transform($date)
    {
        if($date == null) {
            return '';
        }
        return $date->format('d/m/Y');
    }

    /**
     * Transforme une date française en datetime
     */
    public function reverseTransform($frenchDate)
    {
        // ex : frenchDate = 21/01/2020

        if($frenchDate == null) {
            // Exception
            throw new TransformationFailedException("Vous devez fournir une date");
        }

        $date = \DateTime::createFromFormat('d/m/Y', $frenchDate);

        if($date == false ) {
            //Exception
            throw new TransformationFailedException("Le format de la date n'est pas le bon");
        }

        return $date;

    }
}

?>