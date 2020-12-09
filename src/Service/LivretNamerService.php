<?php


namespace App\Service;

use App\Entity\Etudiant;
use App\Entity\Formation;

/**
 * Ce service permet de nommer un livret en fonction du nom de la formation,
 * nom et prénom de l'étudiant apprentis ainsi que la tranche d'années concernées
 *
 * Class LivretNamerService
 * @package App\Service
 */
class LivretNamerService
{

    public function generateLivretName(Formation $formation, Etudiant $etudiant, string $annees) : string {

        return "Livret de la formation ". "<i>" . $formation->getLibelle() . "</i> de l'apprentis " .
            $etudiant->getFullName() . " pour les années " . $annees;

    }

}