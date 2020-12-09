<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Entreprise::class, inversedBy="formations")
     */
    private $entreprises;

    /**
     * @ORM\OneToMany(targetEntity=Livret::class, mappedBy="formation")
     */
    private $livrets;

    public function __construct()
    {
        $this->livrets = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $livret->setFormation($this);
        }

        return $this;
    }

    public function removeLivret(Livret $livret): self
    {
        if ($this->livrets->removeElement($livret)) {
            // set the owning side to null (unless already changed)
            if ($livret->getFormation() === $this) {
                $livret->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entreprise[]
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        $this->entreprises->removeElement($entreprise);

        return $this;
    }
}
