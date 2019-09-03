<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ApiResource(attributes={"filters"={"customer.search"}})
 * @Vich\Uploadable()
 * @UniqueEntity(fields="email", message="Cet email est déjà existant")
 * @UniqueEntity(fields="phone", message="Ce numéro de téléphone est déjà utiliser")
 */
class Customer implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg",
     *     mimeTypesMessage= "Ce type de fichier n'est pas accepté",
     * )
     * @Vich\UploadableField(mapping="customer_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ["ROLE_USERS"];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

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
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $society;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegisterPost", mappedBy="user")
     */
    private $registerPosts;

    /**
     * @ORM\Column(
     *     type="integer",
     *     options={"default": 10}
     * )
     */
    private $points = 10;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cart", mappedBy="user")
     */
    private $carts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Command", mappedBy="customer")
     */
    private $commands;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JobPosts", mappedBy="customer")
     */
    private $jobPosts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageJob", mappedBy="customerMsg")
     */
//    private $messageJobs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageJob", mappedBy="customerPost")
     */
//    private $messageCustomerJobs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageJob", mappedBy="customerPost")
     */
    private $messageCustomerJob;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="customer")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservationSpace", mappedBy="customer")
     */
    private $reservationSpaces;

    public function __construct()
    {
        $this->registerPosts = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->commands = new ArrayCollection();
        $this->jobPosts = new ArrayCollection();
        $this->messageJobs = new ArrayCollection();
        $this->messageCustomerJobs = new ArrayCollection();
        $this->messageCustomerJob = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->reservationSpaces = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSociety(): ?string
    {
        return $this->society;
    }

    public function setSociety(string $society): self
    {
        $this->society = $society;

        return $this;
    }

    /**
     * @return Collection|RegisterPost[]
     */
    public function getRegisterPosts(): Collection
    {
        return $this->registerPosts;
    }

    public function addRegisterPost(RegisterPost $registerPost): self
    {
        if (!$this->registerPosts->contains($registerPost)) {
            $this->registerPosts[] = $registerPost;
            $registerPost->setUser($this);
        }

        return $this;
    }

    public function removeRegisterPost(RegisterPost $registerPost): self
    {
        if ($this->registerPosts->contains($registerPost)) {
            $this->registerPosts->removeElement($registerPost);
            // set the owning side to null (unless already changed)
            if ($registerPost->getUser() === $this) {
                $registerPost->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->id;

    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Customer
     */
    public function setFilename(?string $filename): Customer
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Customer
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): Customer
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile)
        {
            $this->updateAt = new \DateTime('now');
        }
        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setUser($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->contains($cart)) {
            $this->carts->removeElement($cart);
            // set the owning side to null (unless already changed)
            if ($cart->getUser() === $this) {
                $cart->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Command[]
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    public function addCommand(Command $command): self
    {
        if (!$this->commands->contains($command)) {
            $this->commands[] = $command;
            $command->setCustomer($this);
        }

        return $this;
    }

    public function removeCommand(Command $command): self
    {
        if ($this->commands->contains($command)) {
            $this->commands->removeElement($command);
            // set the owning side to null (unless already changed)
            if ($command->getCustomer() === $this) {
                $command->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JobPosts[]
     */
    public function getJobPosts(): Collection
    {
        return $this->jobPosts;
    }

    public function addJobPost(JobPosts $jobPost): self
    {
        if (!$this->jobPosts->contains($jobPost)) {
            $this->jobPosts[] = $jobPost;
            $jobPost->setCustomer($this);
        }

        return $this;
    }

    public function removeJobPost(JobPosts $jobPost): self
    {
        if ($this->jobPosts->contains($jobPost)) {
            $this->jobPosts->removeElement($jobPost);
            // set the owning side to null (unless already changed)
            if ($jobPost->getCustomer() === $this) {
                $jobPost->setCustomer(null);
            }
        }

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
            $messageJob->setCustomerMsg($this);
        }

        return $this;
    }

    public function removeMessageJob(MessageJob $messageJob): self
    {
        if ($this->messageJobs->contains($messageJob)) {
            $this->messageJobs->removeElement($messageJob);
            // set the owning side to null (unless already changed)
            if ($messageJob->getCustomerMsg() === $this) {
                $messageJob->setCustomerMsg(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MessageJob[]
     */
    public function getMessageCustomerJobs(): Collection
    {
        return $this->messageCustomerJobs;
    }

    public function addMessageCustomerJob(MessageJob $messageCustomerJob): self
    {
        if (!$this->messageCustomerJobs->contains($messageCustomerJob)) {
            $this->messageCustomerJobs[] = $messageCustomerJob;
            $messageCustomerJob->setCustomerPost($this);
        }

        return $this;
    }

    public function removeMessageCustomerJob(MessageJob $messageCustomerJob): self
    {
        if ($this->messageCustomerJobs->contains($messageCustomerJob)) {
            $this->messageCustomerJobs->removeElement($messageCustomerJob);
            // set the owning side to null (unless already changed)
            if ($messageCustomerJob->getCustomerPost() === $this) {
                $messageCustomerJob->setCustomerPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MessageJob[]
     */
    public function getMessageCustomerJob(): Collection
    {
        return $this->messageCustomerJob;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setCustomer($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getCustomer() === $this) {
                $booking->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReservationSpace[]
     */
    public function getReservationSpaces(): Collection
    {
        return $this->reservationSpaces;
    }

    public function addReservationSpace(ReservationSpace $reservationSpace): self
    {
        if (!$this->reservationSpaces->contains($reservationSpace)) {
            $this->reservationSpaces[] = $reservationSpace;
            $reservationSpace->setCustomer($this);
        }

        return $this;
    }

    public function removeReservationSpace(ReservationSpace $reservationSpace): self
    {
        if ($this->reservationSpaces->contains($reservationSpace)) {
            $this->reservationSpaces->removeElement($reservationSpace);
            // set the owning side to null (unless already changed)
            if ($reservationSpace->getCustomer() === $this) {
                $reservationSpace->setCustomer(null);
            }
        }

        return $this;
    }

}
