<?php

namespace App\Entity;

use App\Repository\ProfTuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfTuteurRepository::class)
 */
class ProfTuteur extends Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Livret::class, mappedBy="profTuteur")
     */
    private $livrets;

    public function __construct() {

        $this->id = parent::getId();
        $this->setRoles(
            ['ROLE_USER','ROLE_PROFTUTEUR']
        );
        $this->livrets = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
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
            $etudiant->setProfTuteur($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getProfTuteur() === $this) {
                $etudiant->setProfTuteur(null);
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
            $livret->setProfTuteur($this);
        }

        return $this;
    }

    public function removeLivret(Livret $livret): self
    {
        if ($this->livrets->removeElement($livret)) {
            // set the owning side to null (unless already changed)
            if ($livret->getProfTuteur() === $this) {
                $livret->setProfTuteur(null);
            }
        }

        return $this;
    }
}
