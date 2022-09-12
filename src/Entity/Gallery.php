<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator as UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Gallery implements EntityInterface
{
    use EntityTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $title;

    #[ORM\ManyToMany(targetEntity: Photo::class, inversedBy: 'galleries', cascade: ['persist'])]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Photo $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(Photo $image): self
    {
        $this->images->removeElement($image);

        return $this;
    }
}
