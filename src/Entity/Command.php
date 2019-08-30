<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandRepository")
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string")
     */
    private $name_cart;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_cart;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_exp;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_cvv;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="commands")
     */
    private $customer;

    /**
     * @ORM\Column(type="integer")
     */
    private $supply;

    /**
     * @ORM\Column(type="integer")
     */
    private $command_price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getNameCart(): ?string
    {
        return $this->name_cart;
    }

    public function setNameCart(string $name_cart): self
    {
        $this->name_cart = $name_cart;

        return $this;
    }

    public function getNumCart(): ?string
    {
        return $this->num_cart;
    }

    public function setNumCart(string $num_cart): self
    {
        $this->num_cart = $num_cart;

        return $this;
    }

    public function getNumExp(): ?int
    {
        return $this->num_exp;
    }

    public function setNumExp(int $num_exp): self
    {
        $this->num_exp = $num_exp;

        return $this;
    }

    public function getNumCvv(): ?int
    {
        return $this->num_cvv;
    }

    public function setNumCvv(int $num_cvv): self
    {
        $this->num_cvv = $num_cvv;

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

    public function getSupply(): ?int
    {
        return $this->supply;
    }

    public function setSupply(int $supply): self
    {
        $this->supply = $supply;

        return $this;
    }

    public function getCommandPrice(): ?int
    {
        return $this->command_price;
    }

    public function setCommandPrice(int $command_price): self
    {
        $this->command_price = $command_price;

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
