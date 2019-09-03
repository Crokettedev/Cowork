<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpacePrivateRepository")
 * @Vich\Uploadable()
 */
class SpacePrivate
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
     * @Vich\UploadableField(mapping="spaceprivate_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlace;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="space")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservationSpace", mappedBy="space")
     */
    private $reservationSpaces;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->reservationSpaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
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
     * @return SpacePrivate
     */
    public function setImageFile(?File $imageFile): SpacePrivate
    {
        $this->imageFile = $imageFile;
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
     * @return SpacePrivate
     */
    public function setFilename(?string $filename): SpacePrivate
    {
        $this->filename = $filename;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(int $nbPlace): self
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
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
            $booking->setSpace($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getSpace() === $this) {
                $booking->setSpace(null);
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
            $reservationSpace->setSpace($this);
        }

        return $this;
    }

    public function removeReservationSpace(ReservationSpace $reservationSpace): self
    {
        if ($this->reservationSpaces->contains($reservationSpace)) {
            $this->reservationSpaces->removeElement($reservationSpace);
            // set the owning side to null (unless already changed)
            if ($reservationSpace->getSpace() === $this) {
                $reservationSpace->setSpace(null);
            }
        }

        return $this;
    }
}
