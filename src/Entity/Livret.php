<?php

namespace App\Entity;

use App\Repository\LivretRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivretRepository::class)
 */
class Livret
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLivret;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $annee1;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $annee2;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="livrets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=etudiant::class, inversedBy="livrets")
     * @ORM\JoinColumn (nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity=MaitreStage::class, inversedBy="livrets")
     */
    private $maitreStage;

    /**
     * @ORM\ManyToOne(targetEntity=ProfTuteur::class, inversedBy="livrets")
     */
    private $profTuteur;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLivret(): ?string
    {
        return $this->nomLivret;
    }

    public function setNomLivret(string $nomLivret): self
    {
        $this->nomLivret = $nomLivret;

        return $this;
    }

    public function getAnnee1(): ?string
    {
        return $this->annee1;
    }

    public function setAnnee1(string $annee1): self
    {
        $this->annee1 = $annee1;

        return $this;
    }

    public function getAnnee2(): ?string
    {
        return $this->annee2;
    }

    public function setAnnee2(string $annee2): self
    {
        $this->annee2 = $annee2;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }


    public function getAnnees() : string {
        return $this->getAnnee1() . "-" . $this->getAnnee2();
    }

    public function getEtudiant() : ?Etudiant {
        return $this->etudiant;
    }

    public function setEtudiant(?etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getMaitreStage(): ?MaitreStage
    {
        return $this->maitreStage;
    }

    public function setMaitreStage(?MaitreStage $maitreStage): self
    {
        $this->maitreStage = $maitreStage;

        return $this;
    }

    public function getProfTuteur(): ?ProfTuteur
    {
        return $this->profTuteur;
    }

    public function setProfTuteur(?ProfTuteur $profTuteur): self
    {
        $this->profTuteur = $profTuteur;

        return $this;
    }

}
