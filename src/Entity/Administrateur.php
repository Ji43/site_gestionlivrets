<?php

namespace App\Entity;

use App\Repository\AdministrateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdministrateurRepository::class)
 *
 */
class Administrateur extends Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __construct() {
        $this->id = parent::getId();
        $this->setRoles(
          ['ROLE_USER','ROLE_ADMIN']
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
