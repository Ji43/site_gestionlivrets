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
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="livrets", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=etudiant::class, inversedBy="livrets", cascade={"persist"})
     * @ORM\JoinColumn (nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity=MaitreApprentissage::class, inversedBy="livrets", cascade={"persist"})
     */
    private $maitreApprentissage;

    /**
     * @ORM\ManyToOne(targetEntity=ProfTuteur::class, inversedBy="livrets", cascade={"persist"})
     */
    private $profTuteur;

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="livrets", cascade={"persist"})
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

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getMaitreApprentissage(): ?MaitreApprentissage
    {
        return $this->maitreApprentissage;
    }

    public function setMaitreApprentissage(?MaitreApprentissage $maitreApprentissage): self
    {
        $this->maitreApprentissage = $maitreApprentissage;

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

    public function getAllAccounts(): array
    {
        $accounts = array();
        $accounts[] = $this->etudiant;
        $accounts[] = $this->maitreApprentissage;
        $accounts[] = $this->profTuteur;

        return $accounts;
    }

    //Retourne true si l'utilisateur est concerné par ce livret
    public function isConcerned(Compte $compte):bool {
        if($compte == $this->etudiant || $compte == $this->maitreApprentissage || $compte == $this->profTuteur) {
            return true;
        }
        return false;
    }

}
