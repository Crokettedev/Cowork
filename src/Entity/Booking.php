<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @UniqueEntity(fields="beginAt", message="Cette date est déjà prise")
 * @UniqueEntity(fields="endAt", message="Cette date est déjà prise")
 * @UniqueEntity(fields="timeBeginAt", message="Cette date est déjà prise")
 * @UniqueEntity(fields="timeEndAt", message="Cette date est déjà prise")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\DateTime")
     * @Assert\GreaterThan("today")
     */
    private $beginAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlacePublic", inversedBy="bookings")
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timeBeginAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timeEndAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="bookings")
     */
    private $customer;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalPrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SpacePrivate", inversedBy="bookings")
     */
    private $space;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTimeInterface $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPlace(): ?PlacePublic
    {
        return $this->place;
    }

    public function setPlace(?PlacePublic $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->place;

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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
}
