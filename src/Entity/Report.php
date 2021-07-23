<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 */
class Report
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $incidentID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $incidentName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $requestedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $requestedBy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $receivedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ReceivedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIncidentID(): ?int
    {
        return $this->incidentID;
    }

    public function setIncidentID(int $incidentID): self
    {
        $this->incidentID = $incidentID;

        return $this;
    }

    public function getIncidentName(): ?string
    {
        return $this->incidentName;
    }

    public function setIncidentName(string $incidentName): self
    {
        $this->incidentName = $incidentName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRequestedAt(): ?\DateTimeInterface
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(\DateTimeInterface $requestedAt): self
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    public function getRequestedBy(): ?string
    {
        return $this->requestedBy;
    }

    public function setRequestedBy(?string $requestedBy): self
    {
        $this->requestedBy = $requestedBy;

        return $this;
    }

    public function getReceivedBy(): ?string
    {
        return $this->receivedBy;
    }

    public function setReceivedBy(?string $receivedBy): self
    {
        $this->receivedBy = $receivedBy;

        return $this;
    }

    public function getReceivedAt(): ?\DateTimeInterface
    {
        return $this->ReceivedAt;
    }

    public function setReceivedAt(\DateTimeInterface $ReceivedAt): self
    {
        $this->ReceivedAt = $ReceivedAt;

        return $this;
    }
}
