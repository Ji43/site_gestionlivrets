<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=MaitreStage::class, mappedBy="entreprise")
     */
    private $maitreStages;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, mappedBy="entreprise")
     */
    private $formations;

    public function __construct()
    {
        $this->maitreStages = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|MaitreStage[]
     */
    public function getMaitreStages(): Collection
    {
        return $this->maitreStages;
    }

    public function addMaitreStage(MaitreStage $maitreStage): self
    {
        if (!$this->maitreStages->contains($maitreStage)) {
            $this->maitreStages[] = $maitreStage;
            $maitreStage->setEntreprise($this);
        }

        return $this;
    }

    public function removeMaitreStage(MaitreStage $maitreStage): self
    {
        if ($this->maitreStages->removeElement($maitreStage)) {
            // set the owning side to null (unless already changed)
            if ($maitreStage->getEntreprise() === $this) {
                $maitreStage->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setEntreprise($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getEntreprise() === $this) {
                $formation->setEntreprise(null);
            }
        }

        return $this;
    }
}
