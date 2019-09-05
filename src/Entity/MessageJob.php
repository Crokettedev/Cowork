<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageJobRepository")
 */
class MessageJob
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JobPosts", inversedBy="messageJobs")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="messageJobs")
     */
    private $customerMsg;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="messageCustomerJob")
     */
    private $customerPost;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getMessage(): ?JobPosts
    {
        return $this->message;
    }

    public function setMessage(?JobPosts $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCustomerMsg(): ?Customer
    {
        return $this->customerMsg;
    }

    public function setCustomerMsg(?Customer $customerMsg): self
    {
        $this->customerMsg = $customerMsg;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->customerPostId;

    }

    public function getCustomerPost(): ?Customer
    {
        return $this->customerPost;
    }

    public function setCustomerPost(?Customer $customerPost): self
    {
        $this->customerPost = $customerPost;

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
