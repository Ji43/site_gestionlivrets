<?php

namespace App\DataFixtures;

use App\Entity\Administrateur;
use App\Entity\Classe;
use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Entity\Formation;
use App\Entity\Livret;
use App\Entity\MaitreStage;
use App\Entity\ProfTuteur;
use App\Service\LivretNamerService;
use App\Service\usernamePasswordMakerService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $usernamePasswordMaker;
    private $livretNamer;

    public function __construct(UserPasswordEncoderInterface $encoder, usernamePasswordMakerService $usernamePasswordMaker,
                                LivretNamerService $livretNamer
    )

    {
        $this->passwordEncoder = $encoder;
        $this->usernamePasswordMaker = $usernamePasswordMaker;
        $this->livretNamer = $livretNamer;
    }

    public function load(ObjectManager $manager)
    {
        //Objet faker qui permet de générer des jeux de données aléatoires
        $faker = Factory::create("fr_FR");
        //Tableaux d'objets pour piocher à l'intérieur lors des liaisons entre entités
        $classes = array();
        $etudiants = array();
        $profsTuteurs = array();
        //Tableaux de tranches d'années pour générer les livrets
        $annees = array(
            ["2014", "2015"],
            ["2015", "2016"],
            ["2017", "2018"],
            ["2018", "2019"],
            ["2019", "2020"]
        );

        //Un compte administrateur
        $compteAdmin = new Administrateur();
        $compteAdmin->setNom("Admin");
        $compteAdmin->setPrenom("Chartreuse");
        $compteAdmin->setNomUtilisateur("Admin");
        $compteAdmin->setPassword(
            $this->passwordEncoder->encodePassword(
                $compteAdmin, 'test'));
        $manager->persist($compteAdmin);

        //Création des classes
        for ($i = 0; $i < 5; $i++) {

            $classeEleve = new Classe();
            $classeEleve->setNomClasse($faker->sentence(1));
            $manager->persist($classeEleve);
            //Ajout au tableau des classes
            $classes [] = $classeEleve;
        }

        //Création des étudiants
        for ($i = 0; $i < 10; $i++) {

            $compteEtudiant = new Etudiant();

            //On lui attribue une des classes aléatoire du tableau
            $compteEtudiant->setClasse(
                $classes [array_rand($classes)]
            );

            $compteEtudiant->setNom(
                $faker->lastName
            );

            $compteEtudiant->setPrenom(
                $faker->firstName
            );

            $compteEtudiant->setMail(
                $faker->email
            );

            $compteEtudiant->setDateNaissance(
                $faker->dateTimeBetween("01-01-1997", "30-12-2002")
            );
            //On créer son nom d'utilisateur à partir du service de génération
            //de nom d'utilisateur
            $compteEtudiant->setNomUtilisateur(
                $this->usernamePasswordMaker->generateUsername($compteEtudiant));

            $compteEtudiant->setPassword(
                $this->passwordEncoder->encodePassword(
                    $compteEtudiant,
                    "password"
                ));
            $manager->persist($compteEtudiant);
            $etudiants[] = $compteEtudiant;
        }

        //Création des profs tuteurs
        for ($i = 0; $i < 5; $i++) {

            $compteProfTuteur = new ProfTuteur();
            $compteProfTuteur->setNom(
                $faker->lastName
            );

            $compteProfTuteur->setPrenom(
                $faker->firstName
            );

            $compteProfTuteur->setNomUtilisateur(
                $this->usernamePasswordMaker->generateUsername($compteProfTuteur));

            $compteProfTuteur->setPassword(
                $this->passwordEncoder->encodePassword(
                    $compteProfTuteur, "password"
                ));
            $manager->persist($compteProfTuteur);
            $profsTuteurs[] = $compteProfTuteur;
        }

        //Création des entreprises, maîtres de stage, formations et livrets
        for ($i = 0; $i < 10; $i++) {
            $entreprise = new Entreprise();
            $entreprise->setNom(
                $faker->company
            );
            $entreprise->setMail(
                $faker->email
            );
            $entreprise->setAdresse(
                $faker->address
            );
            $entreprise->setTel(
                $faker->phoneNumber
            );
            $manager->persist($entreprise);

            $compteMaitreStage = new MaitreStage();
            $compteMaitreStage->setEntreprise($entreprise);
            $compteMaitreStage->setNom(
                $faker->lastName
            );
            $compteMaitreStage->setPrenom(
                $faker->firstName
            );
            $compteMaitreStage->setNomUtilisateur(
                $this->usernamePasswordMaker->generateUsername($compteMaitreStage)
            );
            $compteMaitreStage->setPassword(
                $this->passwordEncoder->encodePassword(
                    $compteMaitreStage, "password"
                ));
            $manager->persist($compteMaitreStage);

            $formation = new Formation();
            $formation->setLibelle(
                $faker->sentence(2)
            );
            $formation->addEntreprise($entreprise);
            $manager->persist($formation);


            $randomEtudiant = $etudiants[array_rand($etudiants)];
            $uneTrancheAnnee = array_rand($annees);
            $livret = new Livret();
            $livret->setAnnee1(
                $annees [$uneTrancheAnnee][0]
            );

            $livret->setAnnee2(
                $annees [$uneTrancheAnnee][1]
            );

            $livret->setNomLivret(
                $this->livretNamer->generateLivretName(
                    $formation, $randomEtudiant, $livret->getAnnees()
                ));
            $livret->setFormation($formation);
            $livret->setEtudiant(
                $randomEtudiant
            );
            $livret->setProfTuteur($profsTuteurs[array_rand($profsTuteurs)]);
            $livret->setMaitreStage($compteMaitreStage);
            $manager->persist($livret);
        }

        $manager->flush();
    }

}
