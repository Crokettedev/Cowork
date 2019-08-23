<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="carts")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SupplyFood", inversedBy="carts")
     */
    private $food;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SupplyOffice", inversedBy="carts")
     */
    private $office;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Customer
    {
        return $this->user;
    }

    public function setUser(?Customer $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFood(): ?SupplyFood
    {
        return $this->food;
    }

    public function setFood(?SupplyFood $food): self
    {
        $this->food = $food;

        return $this;
    }

    public function getOffice(): ?SupplyOffice
    {
        return $this->office;
    }

    public function setOffice(?SupplyOffice $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
