<?php

namespace App\Entity;

use App\Repository\MaitreStageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaitreStageRepository::class)
 */
class MaitreStage extends Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="maitreStages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity=Livret::class, mappedBy="maitreStage")
     */
    private $livrets;

    public function __construct()
    {
        $this->id = parent::getId();
        $this->setRoles(
            ['ROLE_USER','ROLE_MAITRESTAGE']
        );
        $this->etudiants = new ArrayCollection();
        $this->livrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setMaitreStage($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getMaitreStage() === $this) {
                $etudiant->setMaitreStage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Livret[]
     */
    public function getLivrets(): Collection
    {
        return $this->livrets;
    }

    public function addLivret(Livret $livret): self
    {
        if (!$this->livrets->contains($livret)) {
            $this->livrets[] = $livret;
            $livret->setMaitreStage($this);
        }

        return $this;
    }

    public function removeLivret(Livret $livret): self
    {
        if ($this->livrets->removeElement($livret)) {
            // set the owning side to null (unless already changed)
            if ($livret->getMaitreStage() === $this) {
                $livret->setMaitreStage(null);
            }
        }

        return $this;
    }
}
