<?php

namespace App\DataFixtures;

use App\Entity\Administrateur;
use App\Entity\Classe;
use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Entity\Formation;
use App\Entity\Livret;
use App\Entity\MaitreApprentissage;
use App\Entity\Periode;
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
                                LivretNamerService           $livretNamer
    )

    {
        $this->passwordEncoder = $encoder;
        $this->usernamePasswordMaker = $usernamePasswordMaker;
        $this->livretNamer = $livretNamer;
    }

    public function isTransactional(): bool
    {
        return false;
    }

    //Ici, le but du jeu d'essais est d'obtenir :
    // - Un compte admin
    // - Les classes BTS SIO1, SIO2 et MSW
    // - 3 professeurs qui vont être tuteurs d'élèves apprentis
    // - 6 exemples de formations que peuvent proposer des entreprises
    // - 5 périodes de formations
    // - 30 étudiants dont chacun se forme dans une entreprise (= 30 entreprises) avec un maitre d'apprentissage
    // pour chaque entreprise (= 30 MA). Une entreprise propose de 1 à 3 des formations listées et chaque
    // étudiant en suit une proposée par son entreprise.
    // Un livret constitue l'ensemble des infos sur ce suivi, à savoir : L'étudiant, son entreprise, la formation
    // qu'il suit, son professeur tuteur (choix aléatoire) et son maitre d'apprentissage (qui est celui lié à
    // l'entreprise crée en même temps). A savoir : un étudiant peut avoir plus d'un livret (il peut avoir suivi
    // diverses formations sur diverses périodes), mais ici l'idée est d'en faire un seul par étudiant.

    public function load(ObjectManager $manager)
    {
        //Objet faker qui permet de générer des jeux de données aléatoires
        $faker = Factory::create("fr_FR");
        //Tableaux d'objets pour y piocher à l'intérieur lors des liaisons entre entités
        $formations = array();
        $lesPeriodes = array();
        $profsTuteurs = array();

        //Tableaux des périodes
        $periodes = array(
            ["2014", "2015"],
            ["2015", "2016"],
            ["2017", "2018"],
            ["2018", "2019"],
            ["2019", "2020"]
        );

        //Un compte administrateur
        $compteAdmin = new Administrateur();
        $compteAdmin->setNom("Petit");
        $compteAdmin->setPrenom("Bertrand");
        $compteAdmin->setNomUtilisateur(
            $this->usernamePasswordMaker->generateUsername($compteAdmin)
        );
        $compteAdmin->setPassword(
            $this->passwordEncoder->encodePassword(
                $compteAdmin, 'admin'));
        $manager->persist($compteAdmin);

        //Création des classes

        $classeSio1 = new Classe();
        $classeSio1->setNomClasse("BTS SIO 1ère année");
        $classes[] = $classeSio1;
        $manager->persist($classeSio1);

        $classeSio2 = new Classe();
        $classeSio2->setNomClasse("BTS SIO 2nd année");
        $classes[] = $classeSio2;
        $manager->persist($classeSio2);

        $classeMsw = new Classe();
        $classeMsw->setNomClasse("MSW");
        $classes[] = $classeMsw;
        $manager->persist($classeMsw);

        //Création des profs tuteurs
        $prof1 = new ProfTuteur();
        $prof1->setNom("Cognasse");
        $prof1->setPrenom("Alain");
        $prof1->setNomUtilisateur(
            $this->usernamePasswordMaker->generateUsername($prof1)
        );
        $prof1->setPassword($this->passwordEncoder->encodePassword($prof1, "password"));
        $profsTuteurs[] = $prof1;
        $manager->persist($prof1);

        $prof2 = new ProfTuteur();
        $prof2->setNom("Demars");
        $prof2->setPrenom("Francis");
        $prof2->setNomUtilisateur(
            $this->usernamePasswordMaker->generateUsername($prof2)
        );
        $prof2->setPassword($this->passwordEncoder->encodePassword($prof2, "password"));
        $profsTuteurs[] = $prof2;
        $manager->persist($prof2);

        $prof3 = new ProfTuteur();
        $prof3->setNom("Descours");
        $prof3->setPrenom("Nicolas");
        $prof3->setNomUtilisateur(
            $this->usernamePasswordMaker->generateUsername($prof3)
        );
        $prof3->setPassword($this->passwordEncoder->encodePassword($prof3, "password"));
        $profsTuteurs[] = $prof3;
        $manager->persist($prof3);

        //Création des formations
        $formation1 = new Formation();
        $formation1->setLibelle("Développeur Front-end HTML,CSS,JS et React");
        $formations[] = $formation1;
        $manager->persist($formation1);

        $formation2 = new Formation();
        $formation2->setLibelle("Développeur Full-Stack React et Symfony");
        $formations[] = $formation2;
        $manager->persist($formation2);

        $formation3 = new Formation();
        $formation3->setLibelle("Développeur Full-Stack Angular et PHP native");
        $formations[] = $formation3;
        $manager->persist($formation3);

        $formation4 = new Formation();
        $formation4->setLibelle("Architècte réseaux");
        $formations[] = $formation4;
        $manager->persist($formation4);

        $formation5 = new Formation();
        $formation5->setLibelle("Administrateur réseaux");
        $formations[] = $formation5;
        $manager->persist($formation5);

        $formation6 = new Formation();
        $formation6->setLibelle("Technicien réseaux");
        $formations[] = $formation6;
        $manager->persist($formation6);

        //Création des périodes
        foreach ($periodes as $unePeriode) {
            $periode = new Periode();
            $periode->setAnnee1(
                $unePeriode[0]
            );
            $periode->setAnnee2(
                $unePeriode[1]
            );
            $lesPeriodes[] = $periode;
            $manager->persist($periode);
        }

        for ($i = 0; $i < 30; $i++) {

            //Création des étudiants
            $etudiant = new Etudiant();
            if($i<10) {
                $etudiant->setClasse($classeSio1);
            }
            else if ($i<20) {
                $etudiant->setClasse($classeSio2);
            }
            else {
                $etudiant->setClasse($classeMsw);
            }
            $etudiant->setNom($faker->lastName);
            $etudiant->setPrenom($faker->firstName);
            $etudiant->setMail($faker->email);
            $etudiant->setDateNaissance(
                $faker->dateTimeBetween("01-01-1997", "30-12-2002"
                ));
            $etudiant->setNomUtilisateur(
                $this->usernamePasswordMaker->generateUsername($etudiant)
            );
            $etudiant->setPassword(
                $this->passwordEncoder->encodePassword(
                    $etudiant, "password"
                ));
            $manager->persist($etudiant);

            //Création des entreprises
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

            //Une entreprise peut proposer jusqu'à 3 formations de la liste crée auparavant
            $formationsEntreprises = array();
            $randInt = rand(1,3);
            $randFormations = array_rand($formations,$randInt);

            //Si la fonction array_rand n'a retourné qu'une seule valeur
            if(is_numeric($randFormations)) {
                $entreprise->addFormation($formations[$randFormations]);
                $formationsEntreprises[] = $formations[$randFormations];
            }
            //Si la fonction array_rand a retourné un tableau de valeurs
            else {
                foreach ($randFormations as $f) {
                    $entreprise->addFormation($formations[$f]);
                    $formationsEntreprises[] = $formations[$f];
                }
            }

            $manager->persist($entreprise);

            //Création des maitres d'apprentissage
            $MaitreApprentissage = new MaitreApprentissage();
            $MaitreApprentissage->setNom(
                $faker->lastName
            );
            $MaitreApprentissage->setPrenom(
                $faker->firstName
            );
            $MaitreApprentissage->setNomUtilisateur(
                $this->usernamePasswordMaker->generateUsername($MaitreApprentissage)
            );
            $MaitreApprentissage->setPassword(
                $this->passwordEncoder->encodePassword(
                    $MaitreApprentissage, "password"
                ));
            $MaitreApprentissage->setEntreprise($entreprise);
            $manager->persist($MaitreApprentissage);

            //Création des 30 livrets (1 par étudiant)
            $livret = new Livret();
            $livret->setPeriode($lesPeriodes[array_rand($lesPeriodes)]);

            $indexFormation = array_rand($formationsEntreprises);
            $formation = $formationsEntreprises[$indexFormation];
            $livret->setFormation($formation);

            $livret->setEtudiant($etudiant);
            $livret->setProfTuteur($profsTuteurs[array_rand($profsTuteurs)]);
            $livret->setMaitreApprentissage($MaitreApprentissage);

            $livret->setNomLivret(
                $this->livretNamer->generateLivretName(
                    $livret
                ));
            $manager->persist($livret);
        }

        $manager->flush();
    }
}
