<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\CompteController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *   normalizationContext={"groups"={"readcompte"}},
 *   denormalizationContext={"groups"={"writecompte"}},
 * 
 * collectionOperations={
 * "POST"={
 *     "controller"=CompteController::class,
 *     "access_control"="is_granted('POST', object)",
 * 
 *      },
 * 
 * "GETALL"={
 * "method"="GET",
 *   }
 * },
 * 
 * itemOperations={
 *    
 * "recuperation"={
 *      "method"="GET",
 * },
 * 
 * "PUT"={
 *     "controller"=CompteController::class,
 *    "access_control"="is_granted('EDIT', object)",  
 * },
 * }
 * )
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
     * @Groups({"readcompte", "writecompte"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerocompte;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createat;

    /**
     * @Groups({"readcompte", "writecompte"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $soldecompte;

    /**
     * @Groups({"readcompte", "writecompte"})
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="compte", cascade={"persist"})
     */
    private $depots;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comptes")
     */
    private $user;

    /**
     * @Groups({"readcompte", "writecompte"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="comptes", cascade={"persist"})
     */
    private $partenaire;

    public function __construct()
    {
        $a = "wra";
        $b = rand(100000, 990000);
        $this->numerocompte = $a.$b;

        $this->createat = new \DateTime();
        $this->users = new ArrayCollection();
        $this->depots = new ArrayCollection();
    }

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


    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setCompte($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getCompte() === $this) {
                $depot->setCompte(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }
}
