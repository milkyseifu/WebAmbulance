<?php

namespace App\Entity;

use App\Repository\DriversRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DriversRepository::class)
 */
class Drivers implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *  * @Assert\Length(
     *     min = 4,
     *     max = 50,
     *     minMessage = "Username cannot be at least {{ limit }} characters long",
     *     maxMessage = "Username cannot be longer than {{ limit }} characters"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     *  * @Assert\Length(
     *     min = 2,
     *     max = 50,
     *     minMessage = "Name cannot be at least {{ limit }} characters long",
     *     maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     *  * @Assert\Length(
     *     min = 2,
     *     max = 50,
     *     minMessage = "Name cannot be at least {{ limit }} characters long",
     *     maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     */
    private $LastName;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/^(\+251|0)9[0-9]{8}/",
     *     match=true,
     *     message="Invalid phone number"
     * )
     */
    private $PhoneNumber;

    /**
     * @ORM\ManyToOne(targetEntity=Ambulance::class, inversedBy="drivers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ambulance;


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
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_DRIVER';

        return array_unique($roles);
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
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->Age;
    }

    public function setAge(string $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->Sex;
    }

    public function setSex(string $Sex): self
    {
        $this->Sex = $Sex;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getAmbulance(): ?Ambulance
    {
        return $this->ambulance;
    }

    public function setAmbulance(?Ambulance $ambulance): self
    {
        $this->ambulance = $ambulance;

        return $this;
    }

}
