<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\MagicConst\File;
use Ramsey\Uuid\Doctrine\UuidGenerator as UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Post implements EntityInterface
{
    use EntityTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $content;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image;

    private File $file;

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

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
