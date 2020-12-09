<?php

namespace App\Service;

use App\Entity\Compte;
use App\Entity\Etudiant;
use App\Entity\ProfTuteur;

/**
 *
 * Ce service permet de générer un nom d'utilisateur et un mot de passe à partir des différents besoins qui se
 * rapportent aux comptes. Les noms d'utilisateurs deviennent "nom.prenom". Le mot de passe d'un étudiant se
 * constitue comme ceci avec comme exemple "Alexandre Bertrand" né le 01/01/2000 : ET-Ab01012000 avec "ET"
 * derrière pour étudiant. Le même principe est utilisé pour le professeur tuteur mais au lieu de sa date
 * de naissance car elle n'est pas renseignée dans ce cas, il s'agit de laCHARTREUSE@43000 avec comme prefixe
 * PT. (ex : PT-AblaCHARTREUSE@43000) Enfin pour le maitre de stage, c'est la même chose mais la fin du mot
 * de passe se constitue du nom de son entreprise en majuscule avec un arobase à la fin. (ex : MS-AbEUREKA43@)
 *
 *
 */
class usernamePasswordMakerService
{

    /**
     * @param string $nom
     * @param string $prenom
     * @return string
     */
    public function generateUsername(Compte $entity): string
    {
        return strtolower($entity->getNom() . "." . $entity->getPrenom());
    }

    /**
     * Permet de générer le mot de passe
     *
     * @param Compte $entity
     * @return string
     */
    public function generatePassword(Compte $entity): string
    {

        $password = "";
        $nom = $entity->getNom();
        $prenom = $entity->getPrenom();

        $initialeNom = strtolower($nom[0]);
        $initialePrenom = strtoupper($prenom[0]);
        $touteInitiales = $initialePrenom . $initialeNom;

        if ($entity instanceof Etudiant) {

            $stringDate = date_format($entity->getDateNaissance(), 'd-m-Y');
            $dateNaissance = str_replace("-", "", $stringDate);
            $password .= "ET-" . $touteInitiales . $dateNaissance;
        }
        elseif ($entity instanceof ProfTuteur) {

            $password .= "PT-" . $touteInitiales . "laCHARTREUSE@43000";
        }
        else {

            $nomEntreprise = $entity->getEntreprise()->getNom();
            $caracteres = array("-", " ");
            $nomEntrepriseFiltre = strtoupper(
                str_replace($caracteres, "", $nomEntreprise)
            );

            $password .= "MS-" . $touteInitiales . $nomEntrepriseFiltre . "@";
        }

        return $password;
    }

}