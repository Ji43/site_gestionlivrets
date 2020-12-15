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

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="livrets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $periode;


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

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
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

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

}
