<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobPostsRepository")
 */
class JobPosts
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
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="jobPosts")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageJob", mappedBy="message")
     */
//    private $messageJobs;
//
//    public function __construct()
//    {
//        $this->messageJobs = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSlug(): string {

        return (new Slugify())->slugify($this->title);
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|MessageJob[]
     */
    public function getMessageJobs(): Collection
    {
        return $this->messageJobs;
    }

    public function addMessageJob(MessageJob $messageJob): self
    {
        if (!$this->messageJobs->contains($messageJob)) {
            $this->messageJobs[] = $messageJob;
            $messageJob->setMessage($this);
        }

        return $this;
    }

    public function removeMessageJob(MessageJob $messageJob): self
    {
        if ($this->messageJobs->contains($messageJob)) {
            $this->messageJobs->removeElement($messageJob);
            // set the owning side to null (unless already changed)
            if ($messageJob->getMessage() === $this) {
                $messageJob->setMessage(null);
            }
        }

        return $this;
    }
}
