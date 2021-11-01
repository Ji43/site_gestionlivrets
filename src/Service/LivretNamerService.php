<?php


namespace App\Service;

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

    public function generateLivretName(Livret $livret) {

        $name = "Formation ". "<i>" . $livret->getFormation()->getLibelle() . "</i> de l'apprentis " .
            $livret->getEtudiant()->getFullName() . " pour la période " . $livret->getPeriode()->getAnnees();

        if(empty($livret->getNomLivret())) {
            $livret->setNomLivret($name);
        }

    }
}