<?php

namespace App\DataFixtures;

use App\Entity\Administrateur;
use App\Entity\Compte;
use App\Entity\Etudiant;
use App\Service\usernamePasswordMakerService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    private $usernamePasswordMaker;

    public function __construct(UserPasswordEncoderInterface $encoder, usernamePasswordMakerService $usernamePasswordMaker)
    {
        $this->passwordEncoder = $encoder;
        $this->usernamePasswordMaker = $usernamePasswordMaker;
    }

    public function load(ObjectManager $manager)
    {
//        $compteAdmin = new Administrateur();
//        $compteAdmin->setNomUtilisateur("Admin");
//        $compteAdmin->setPassword(
//            $this->passwordEncoder->encodePassword(
//                $compteAdmin,'test'));
//        $manager->persist($compteAdmin);

        $compteEtudiant = new Etudiant();
        $compteEtudiant->setNom("Latreille");
        $compteEtudiant->setPrenom("Jillali");
        $compteEtudiant->setMail("jillali.latreille@laposte.net");
        $compteEtudiant->setDateNaissance(new \DateTime('08-04-1998'));

        $compteEtudiant->setNomUtilisateur(
            $this->usernamePasswordMaker->generateUsername($compteEtudiant->getNom(),$compteEtudiant->getPrenom()
            ));

//        $compteEtudiant->setPassword(
//            $this->passwordEncoder->encodePassword(
//                $compteEtudiant,
//                $this->usernamePasswordMaker->generatePassword($compteEtudiant)
//            ));

        $compteEtudiant->setPassword(
                $this->usernamePasswordMaker->generatePassword($compteEtudiant)
        );

        $manager->persist($compteEtudiant);
        $manager->flush();
    }
}
