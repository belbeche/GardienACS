<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BuildingRepository::class)
 */
class Building
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Lights;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Floor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLights(): ?bool
    {
        return $this->Lights;
    }

    public function setLights(bool $Lights): self
    {
        $this->Lights = $Lights;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->Floor;
    }

    public function setFloor(string $Floor): self
    {
        $this->Floor = $Floor;

        return $this;
    }

    public function getUsers(): ?string
    {
        return $this->Users;
    }

    public function setUsers(string $Users): self
    {
        $this->Users = $Users;

        return $this;
    }
}
