<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantdepot;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedepot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantdepot(): ?int
    {
        return $this->montantdepot;
    }

    public function setMontantdepot(?int $montantdepot): self
    {
        $this->montantdepot = $montantdepot;

        return $this;
    }

    public function getDatedepot(): ?\DateTimeInterface
    {
        return $this->datedepot;
    }

    public function setDatedepot(?\DateTimeInterface $datedepot): self
    {
        $this->datedepot = $datedepot;

        return $this;
    }
}
