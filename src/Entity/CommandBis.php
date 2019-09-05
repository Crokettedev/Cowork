<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandBisRepository")
 */
class CommandBis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SupplyFood", inversedBy="commandBis")
     */
    private $supplyFood;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SupplyOffice", inversedBy="commandBis")
     */
    private $supplyOffice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="commandBis")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplyFood(): ?SupplyFood
    {
        return $this->supplyFood;
    }

    public function setSupplyFood(?SupplyFood $supplyFood): self
    {
        $this->supplyFood = $supplyFood;

        return $this;
    }

    public function getSupplyOffice(): ?SupplyOffice
    {
        return $this->supplyOffice;
    }

    public function setSupplyOffice(?SupplyOffice $supplyOffice): self
    {
        $this->supplyOffice = $supplyOffice;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
