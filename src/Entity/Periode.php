<?php

namespace App\Entity;

use App\Repository\PeriodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeriodeRepository::class)
 */
class Periode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $annee1;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $annee2;

    /**
     * @ORM\OneToMany(targetEntity=Livret::class, mappedBy="periode")
     */
    private $livrets;

    public function __construct()
    {
        $this->livrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $livret->setPeriode($this);
        }

        return $this;
    }

    public function removeLivret(Livret $livret): self
    {
        if ($this->livrets->removeElement($livret)) {
            // set the owning side to null (unless already changed)
            if ($livret->getPeriode() === $this) {
                $livret->setPeriode(null);
            }
        }

        return $this;
    }

    public function getAnnees() : string {
        return $this->getAnnee1() . "-" . $this->getAnnee2();
    }
}
