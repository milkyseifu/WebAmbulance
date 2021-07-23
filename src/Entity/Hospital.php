<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HospitalRepository::class)
 */
class Hospital
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $HospitalName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $Capacity;

    /**
     * @ORM\OneToMany(targetEntity=Ambulance::class, mappedBy="hospital")
     */
    private $ambulances;

    public function __construct()
    {
        $this->ambulances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHospitalName(): ?string
    {
        return $this->HospitalName;
    }

    public function setHospitalName(string $HospitalName): self
    {
        $this->HospitalName = $HospitalName;

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

    public function getCapacity(): ?string
    {
        return $this->Capacity;
    }

    public function setCapacity(string $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    /**
     * @return Collection|Ambulance[]
     */
    public function getAmbulances(): Collection
    {
        return $this->ambulances;
    }

    public function addAmbulance(Ambulance $ambulance): self
    {
        if (!$this->ambulances->contains($ambulance)) {
            $this->ambulances[] = $ambulance;
            $ambulance->setHospital($this);
        }

        return $this;
    }

    public function removeAmbulance(Ambulance $ambulance): self
    {
        if ($this->ambulances->removeElement($ambulance)) {
            // set the owning side to null (unless already changed)
            if ($ambulance->getHospital() === $this) {
                $ambulance->setHospital(null);
            }
        }

        return $this;
    }

}
