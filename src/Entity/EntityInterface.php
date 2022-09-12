<?php

namespace App\Entity;

interface EntityInterface
{
    public function getId(): string;

    public function getCreatedAt(): \DateTimeImmutable;

    public function getUpdatedAt(): \DateTimeImmutable;
}