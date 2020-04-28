<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\UserController;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;


/**
 * @ApiFilter(BooleanFilter::class, properties={"isActive"})
 * @ApiResource(
 * normalizationContext={"groups"={"lire"}},
 * denormalizationContext={"groups"={"ecrire"}},
 * collectionOperations={
 * 
 * 
 * "POST"={
 *       "controller"=UserController::class,
 *       "access_control"="is_granted('POST', object)",
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
 
 * "PUT"={
 * "access_control"="is_granted('EDIT', object)",
 
 * },
 * }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @Groups({"lire", "ecrire"})
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"lire", "ecrire"})
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @Groups({"lire", "ecrire"})
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @Groups({"lire", "ecrire"})
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups({"lire", "ecrire"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @Groups({"lire", "ecrire"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomcomplet;

    /**
     * @Groups({"lire", "ecrire"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     */
    private $role;


    public function __construct()
    {

        $this->isActive = true;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {

      //  return ["ROLE_".$this->role->getLibelle()];
    $this->roles = 'ROLE_'.strtoupper($this->role->getLibelle());
        // guarantee every user at least has ROLE_USER
     return array($this->roles);
      
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getNomcomplet(): ?string
    {
        return $this->nomcomplet;
    }

    public function setNomcomplet(?string $nomcomplet): self
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }



}
