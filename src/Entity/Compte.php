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
     * @Groups({"readaffectation", "writeaffectation"})
     * @Groups({"readdepot", "writedepot"})
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
     * @Groups({"readcompte", "writecompte"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comptes")
     */
    private $user;

    /**
     * @Groups({"readcompte", "writecompte"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="comptes", cascade={"persist"})
     */
    private $partenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affectation", mappedBy="compte")
     */
    private $affectations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="compteenvoi")
     */
    private $transactionenvois;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="compteretrait")
     */
    private $transactionretraits;

   

    public function __construct()
    {
        $a = "wra";
        $b = rand(100000, 990000);
        $this->numerocompte = $a.$b;

        $this->createat = new \DateTime();
        $this->users = new ArrayCollection();
        $this->depots = new ArrayCollection();
        $this->affectations = new ArrayCollection();
        $this->transactionenvois = new ArrayCollection();
        $this->transactionretraits = new ArrayCollection();
        
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

    /**
     * @return Collection|Affectation[]
     */
    public function getAffectations(): Collection
    {
        return $this->affectations;
    }

    public function addAffectation(Affectation $affectation): self
    {
        if (!$this->affectations->contains($affectation)) {
            $this->affectations[] = $affectation;
            $affectation->setCompte($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): self
    {
        if ($this->affectations->contains($affectation)) {
            $this->affectations->removeElement($affectation);
            // set the owning side to null (unless already changed)
            if ($affectation->getCompte() === $this) {
                $affectation->setCompte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactionenvois(): Collection
    {
        return $this->transactionenvois;
    }

    public function addTransactionenvois(Transaction $transactionenvois): self
    {
        if (!$this->transactionenvois->contains($transactionenvois)) {
            $this->transactionenvois[] = $transactionenvois;
            $transactionenvois->setCompteenvoi($this);
        }

        return $this;
    }

    public function removeTransactionenvois(Transaction $transactionenvois): self
    {
        if ($this->transactionenvois->contains($transactionenvois)) {
            $this->transactionenvois->removeElement($transactionenvois);
            // set the owning side to null (unless already changed)
            if ($transactionenvois->getCompteenvoi() === $this) {
                $transactionenvois->setCompteenvoi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactionretraits(): Collection
    {
        return $this->transactionretraits;
    }

    public function addTransactionretrait(Transaction $transactionretrait): self
    {
        if (!$this->transactionretraits->contains($transactionretrait)) {
            $this->transactionretraits[] = $transactionretrait;
            $transactionretrait->setCompteretrait($this);
        }

        return $this;
    }

    public function removeTransactionretrait(Transaction $transactionretrait): self
    {
        if ($this->transactionretraits->contains($transactionretrait)) {
            $this->transactionretraits->removeElement($transactionretrait);
            // set the owning side to null (unless already changed)
            if ($transactionretrait->getCompteretrait() === $this) {
                $transactionretrait->setCompteretrait(null);
            }
        }

        return $this;
    }

   
   
}
