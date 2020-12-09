<?php

namespace App\Entity;

use App\Repository\FicheSuiviRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FicheSuiviRepository::class)
 */
class FicheSuivi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $compTrans;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $compTech;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $obsForm;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $obsApp;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $obsMa;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $missions;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $messageENT;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $repForm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCompTrans(): ?string
    {
        return $this->compTrans;
    }

    public function setCompTrans(?string $compTrans): self
    {
        $this->compTrans = $compTrans;

        return $this;
    }

    public function getCompTech(): ?string
    {
        return $this->compTech;
    }

    public function setCompTech(?string $compTech): self
    {
        $this->compTech = $compTech;

        return $this;
    }

    public function getObsForm(): ?string
    {
        return $this->obsForm;
    }

    public function setObsForm(?string $obsForm): self
    {
        $this->obsForm = $obsForm;

        return $this;
    }

    public function getObsApp(): ?string
    {
        return $this->obsApp;
    }

    public function setObsApp(?string $obsApp): self
    {
        $this->obsApp = $obsApp;

        return $this;
    }

    public function getObsMa(): ?string
    {
        return $this->obsMa;
    }

    public function setObsMa(?string $obsMa): self
    {
        $this->obsMa = $obsMa;

        return $this;
    }

    public function getMissions(): ?string
    {
        return $this->missions;
    }

    public function setMissions(?string $missions): self
    {
        $this->missions = $missions;

        return $this;
    }

    public function getMessageENT(): ?string
    {
        return $this->messageENT;
    }

    public function setMessageENT(?string $messageENT): self
    {
        $this->messageENT = $messageENT;

        return $this;
    }

    public function getRepForm(): ?string
    {
        return $this->repForm;
    }

    public function setRepForm(?string $repForm): self
    {
        $this->repForm = $repForm;

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
}
