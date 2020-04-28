<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerocompte;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $soldecompte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerocompte(): ?string
    {
        return $this->numerocompte;
    }

    public function setNumerocompte(?string $numerocompte): self
    {
        $this->numerocompte = $numerocompte;

        return $this;
    }

    public function getCreateat(): ?\DateTimeInterface
    {
        return $this->createat;
    }

    public function setCreateat(?\DateTimeInterface $createat): self
    {
        $this->createat = $createat;

        return $this;
    }

    public function getSoldecompte(): ?int
    {
        return $this->soldecompte;
    }

    public function setSoldecompte(?int $soldecompte): self
    {
        $this->soldecompte = $soldecompte;

        return $this;
    }
}
