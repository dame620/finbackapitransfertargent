<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\TransactionController;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiFilter(DateFilter::class, properties={"datetrans"})
 * @ApiResource(
 * 
 *  normalizationContext={"groups"={"readtransaction"}},
 *  denormalizationContext={"groups"={"writetransaction"}},
 * 
 * collectionOperations={
 * "POST"={
 *     "controller"=TransactionController::class,
 *    
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
 *     "controller"=TransactionController::class,
 *     "access_control"="is_granted('EDIT', object)", 
 * },
 * }
 * 
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montanttransaction;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomemmeteur;

    /**
     * @ApiFilter(SearchFilter::class, properties={"code": "exact"})
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomdestinataire;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telemetteur;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $teldestinataire;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frais;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partenvoyeur;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partretrait;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partsysteme;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partetat;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="transactionenvois")
     */
    private $compteenvoi;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="transactionretraits")
     */
    private $compteretrait;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transactionenvois")
     */
    private $userenvoi;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transactionretraits")
     */
    private $userretrait;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cniemetteur;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cnidestinataire;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $statu;

    /**
     * @Groups({"readtransaction", "writetransaction"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $datetrans;


    public function __construct()
    {
        $this->datetrans = new \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontanttransaction(): ?int
    {
        return $this->montanttransaction;
    }

    public function setMontanttransaction(?int $montanttransaction): self
    {
        $this->montanttransaction = $montanttransaction;

        return $this;
    }

    public function getNomemmeteur(): ?string
    {
        return $this->nomemmeteur;
    }

    public function setNomemmeteur(?string $nomemmeteur): self
    {
        $this->nomemmeteur = $nomemmeteur;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNomdestinataire(): ?string
    {
        return $this->nomdestinataire;
    }

    public function setNomdestinataire(?string $nomdestinataire): self
    {
        $this->nomdestinataire = $nomdestinataire;

        return $this;
    }

    public function getTelemetteur(): ?string
    {
        return $this->telemetteur;
    }

    public function setTelemetteur(?string $telemetteur): self
    {
        $this->telemetteur = $telemetteur;

        return $this;
    }

    public function getTeldestinataire(): ?int
    {
        return $this->teldestinataire;
    }

    public function setTeldestinataire(?int $teldestinataire): self
    {
        $this->teldestinataire = $teldestinataire;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(?int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getPartenvoyeur(): ?int
    {
        return $this->partenvoyeur;
    }

    public function setPartenvoyeur(?int $partenvoyeur): self
    {
        $this->partenvoyeur = $partenvoyeur;

        return $this;
    }

    public function getPartretrait(): ?int
    {
        return $this->partretrait;
    }

    public function setPartretrait(?int $partretrait): self
    {
        $this->partretrait = $partretrait;

        return $this;
    }

    public function getPartsysteme(): ?int
    {
        return $this->partsysteme;
    }

    public function setPartsysteme(?int $partsysteme): self
    {
        $this->partsysteme = $partsysteme;

        return $this;
    }

    public function getPartetat(): ?int
    {
        return $this->partetat;
    }

    public function setPartetat(?int $partetat): self
    {
        $this->partetat = $partetat;

        return $this;
    }

    public function getCompteenvoi(): ?Compte
    {
        return $this->compteenvoi;
    }

    public function setCompteenvoi(?Compte $compteenvoi): self
    {
        $this->compteenvoi = $compteenvoi;

        return $this;
    }

    public function getCompteretrait(): ?Compte
    {
        return $this->compteretrait;
    }

    public function setCompteretrait(?Compte $compteretrait): self
    {
        $this->compteretrait = $compteretrait;

        return $this;
    }

    public function getUserenvoi(): ?User
    {
        return $this->userenvoi;
    }

    public function setUserenvoi(?User $userenvoi): self
    {
        $this->userenvoi = $userenvoi;

        return $this;
    }

    public function getUserretrait(): ?User
    {
        return $this->userretrait;
    }

    public function setUserretrait(?User $userretrait): self
    {
        $this->userretrait = $userretrait;

        return $this;
    }

    public function getCniemetteur(): ?int
    {
        return $this->cniemetteur;
    }

    public function setCniemetteur(?int $cniemetteur): self
    {
        $this->cniemetteur = $cniemetteur;

        return $this;
    }

    public function getCnidestinataire(): ?int
    {
        return $this->cnidestinataire;
    }

    public function setCnidestinataire(?int $cnidestinataire): self
    {
        $this->cnidestinataire = $cnidestinataire;

        return $this;
    }

    public function getStatu(): ?bool
    {
        return $this->statu;
    }

    public function setStatu(?bool $statu): self
    {
        $this->statu = $statu;

        return $this;
    }

    public function getDatetrans(): ?\DateTimeInterface
    {
        return $this->datetrans;
    }

    public function setDatetrans(?\DateTimeInterface $datetrans): self
    {
        $this->datetrans = $datetrans;

        return $this;
    }
}
