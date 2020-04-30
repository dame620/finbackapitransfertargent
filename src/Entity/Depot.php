<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\DepotController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *  normalizationContext={"groups"={"readdepot"}},
 *  denormalizationContext={"groups"={"writedepot"}},
 * 
 * collectionOperations={
 * "POST"={
 *     "controller"=DepotController::class,
 *     "access_control"="is_granted('POST', object)",
 * 
 *      },
 * 
 * "GETALLUSER"={
 * "method"="GET",
 *
 *   }
 * },
 * 
 * itemOperations={
 *    
 * "recuperationadmin"={
 *      "method"="GET",
 *      
 * },
 * 
 * "PUT"={
 *      "access_control"="is_granted('EDIT', object)",
 *      "controller"=DepotController::class,
 * },
 * }
 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
{
    /**
     * @Groups({"readdepot", "writedepot"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"readdepot", "writedepot"})
     * @Groups({"readcompte", "writecompte"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantdepot;

    /**
     * @Groups({"readdepot", "writedepot"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedepot;

 
    /**
     * @Groups({"readdepot", "writedepot"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="depots")
     */
    private $compte;

    /**
     * @Groups({"readcompte", "writecompte"})
     * @Groups({"readdepot", "writedepot"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depots")
     */
    private $user;

    public function __construct(){ 

        $this->datedepot = new \DateTime();

       }


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


    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

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
}
