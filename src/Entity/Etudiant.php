<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use App\Service\usernamePasswordMakerService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant extends Compte
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
    private $mail;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;


    /**
     * @ORM\OneToMany(targetEntity=Livret::class, mappedBy="etudiant")
     */
    private $livrets;


    public function __construct(){

        $this->id = parent::getId();
        $this->setRoles(
            ['ROLE_USER','ROLE_ETUDIANT']
        );
        $this->livrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

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
            $livret->setEtudiant($this);
        }

        return $this;
    }

    public function removeLivret(Livret $livret): self
    {
        if ($this->livrets->removeElement($livret)) {
            // set the owning side to null (unless already changed)
            if ($livret->getEtudiant() === $this) {
                $livret->setEtudiant(null);
            }
        }

        return $this;
    }



}
