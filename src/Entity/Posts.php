<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 * @Vich\Uploadable()
 */
class Posts
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
     * @Vich\UploadableField(mapping="event_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\OneToMany(targetEntity="App\Entity\RegisterPost", mappedBy="post")
     */
    private $registerPosts;

    public function __construct()
    {
        $this->registerPosts = new ArrayCollection();
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->id;

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
            $registerPost->setPost($this);
        }

        return $this;
    }

    public function removeRegisterPost(RegisterPost $registerPost): self
    {
        if ($this->registerPosts->contains($registerPost)) {
            $this->registerPosts->removeElement($registerPost);
            // set the owning side to null (unless already changed)
            if ($registerPost->getPost() === $this) {
                $registerPost->setPost(null);
            }
        }

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
     * @return Posts
     */
    public function setFilename(?string $filename): Posts
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return FileType|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Posts
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): Posts
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile)
        {
            $this->updateAt = new \DateTime('now');
        }
        return $this;
    }

}
