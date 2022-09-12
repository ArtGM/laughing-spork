<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator as UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Member implements EntityInterface
{
    use EntityTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lastName;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $resume;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photo;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

}
