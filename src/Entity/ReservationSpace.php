<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationSpaceRepository")
 * @UniqueEntity(fields="beginAt", message="Cette date est déjà prise")
 * @UniqueEntity(fields="endAt", message="Cette date est déjà prise")
 * @UniqueEntity(fields="timeBeginAt", message="Cette date est déjà prise")
 * @UniqueEntity(fields="timeEndAt", message="Cette date est déjà prise")
 */
class ReservationSpace
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $beginAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $timeBeginAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $timeEndAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SpacePrivate", inversedBy="reservationSpaces")
     */
    private $space;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="reservationSpaces")
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginAt(): ?string
    {
        return $this->beginAt;
    }

    public function setBeginAt(string $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?string
    {
        return $this->endAt;
    }

    public function setEndAt(string $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getTimeBeginAt(): ?string
    {
        return $this->timeBeginAt;
    }

    public function setTimeBeginAt(string $timeBeginAt): self
    {
        $this->timeBeginAt = $timeBeginAt;

        return $this;
    }

    public function getTimeEndAt(): ?string
    {
        return $this->timeEndAt;
    }

    public function setTimeEndAt(string $timeEndAt): self
    {
        $this->timeEndAt = $timeEndAt;

        return $this;
    }

    public function getSpace(): ?SpacePrivate
    {
        return $this->space;
    }

    public function setSpace(?SpacePrivate $space): self
    {
        $this->space = $space;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
