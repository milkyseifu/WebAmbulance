<?php

namespace App\Entity;

use App\Repository\AmbulanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AmbulanceRepository::class)
 */
class Ambulance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *     * @Assert\Length(
     *     min = 2,
     *     max = 50,
     *     minMessage = "Name must be at least {{ limit }} characters long",
     *     maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     */
    private $AmbulanceName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *     * @Assert\Length(
     *     min = 5,
     *     max = 7,
     *     minMessage = "Plate Number Cannot less than {{ limit }} characters long",
     *     maxMessage = "Plate number cannot be longer than {{ limit }} characters"
     * )
     */
    private $PlateNumber;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     *     * @Assert\Length(
     *     min = 1,
     *     minMessage = "Capacity cannot not less than {{ limit }} characters long",
     * )
     */
    private $Capacity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity=Drivers::class, mappedBy="ambulance")
     */
    private $drivers;

    /**
     * @ORM\ManyToOne(targetEntity=Hospital::class, inversedBy="ambulances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hospital;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmbulanceName(): ?string
    {
        return $this->AmbulanceName;
    }

    public function setAmbulanceName(string $AmbulanceName): self
    {
        $this->AmbulanceName = $AmbulanceName;

        return $this;
    }

    public function getPlateNumber(): ?string
    {
        return $this->PlateNumber;
    }

    public function setPlateNumber(string $PlateNumber): self
    {
        $this->PlateNumber = $PlateNumber;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->Capacity;
    }

    public function setCapacity(string $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Drivers[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(Drivers $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->setAmbulance($this);
        }

        return $this;
    }

    public function removeDriver(Drivers $driver): self
    {
        if ($this->drivers->removeElement($driver)) {
            // set the owning side to null (unless already changed)
            if ($driver->getAmbulance() === $this) {
                $driver->setAmbulance(null);
            }
        }

        return $this;
    }

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }
}
