<?php


namespace App\Service;

use App\Entity\Etudiant;
use App\Entity\Formation;
use App\Entity\Livret;

/**
 * Ce service permet de nommer un livret en fonction du nom de la formation,
 * nom et prénom de l'étudiant apprentis ainsi que la tranche d'années concernées
 *
 * Class LivretNamerService
 * @package App\Service
 */
class LivretNamerService
{

    public function generateLivretName(Livret $livret) : string {

        return "Formation ". "<i>" . $livret->getFormation()->getLibelle() . "</i> de l'apprentis " .
            $livret->getEtudiant()->getFullName() . " pour les années " . $livret->getPeriode()->getAnnees();

    }

}