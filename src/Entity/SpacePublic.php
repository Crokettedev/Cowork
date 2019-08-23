<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Cocur\Slugify\Slugify;
/**
 * @ORM\Entity(repositoryClass="App\Repository\SpacePublicRepository")
 * @Vich\Uploadable()
 */
class SpacePublic
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
     *     mimeTypes="image/jpg",
     *     mimeTypesMessage= "Ce type de fichier n'est pas accepté",
     * )
     * @Vich\UploadableField(mapping="space_image", fileNameProperty="filename")
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
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlacePublic", mappedBy="place_public")
     */
    private $placePublics;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    public function __construct()
    {
        $this->placePublics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
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
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
     * @return SpacePublic
     */
    public function setFilename(?string $filename): SpacePublic
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
     * @param null|File $imageFile
     * @return SpacePublic
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): SpacePublic
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile)
        {
            $this->updateAt = new \DateTime('now');
        }
        return $this;
    }





    /**
     * @return Collection|PlacePublic[]
     */
    public function getPlacePublics(): Collection
    {
        return $this->placePublics;
    }

    public function addPlacePublic(PlacePublic $placePublic): self
    {
        if (!$this->placePublics->contains($placePublic)) {
            $this->placePublics[] = $placePublic;
            $placePublic->setPlacePublic($this);
        }

        return $this;
    }

    public function removePlacePublic(PlacePublic $placePublic): self
    {
        if ($this->placePublics->contains($placePublic)) {
            $this->placePublics->removeElement($placePublic);
            // set the owning side to null (unless already changed)
            if ($placePublic->getPlacePublic() === $this) {
                $placePublic->setPlacePublic(null);
            }
        }

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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->id;

    }

}
