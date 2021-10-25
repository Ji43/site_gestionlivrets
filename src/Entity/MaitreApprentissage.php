<?php

namespace App\Entity;

use App\Repository\MaitreApprentissageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaitreApprentissageRepository::class)
 */
class MaitreApprentissage extends Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="maitreApprentissages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity=Livret::class, mappedBy="maitreApprentissages")
     */
    private $livrets;

    public function __construct()
    {
        $this->id = parent::getId();
        $this->setRoles(
            ['ROLE_USER','ROLE_MAITREAPPRENTISSAGE']
        );
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
            $livret->setMaitreApprentissage($this);
        }

        return $this;
    }

    public function removeLivret(Livret $livret): self
    {
        if ($this->livrets->removeElement($livret)) {
            // set the owning side to null (unless already changed)
            if ($livret->getMaitreApprentissage() === $this) {
                $livret->setMaitreApprentissage(null);
            }
        }

        return $this;
    }
}
