<?php

namespace App\Entity;

use App\Repository\WebBlockRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WebBlockRepository::class)]
class WebBlock
{
    public const TYPE_BANNER = 'banner';
    public const TYPE_EVENT = 'event';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_block:index', 'web_block:show', 'web_block:create', 'web_block:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_block:index', 'web_block:show', 'web_block:create', 'web_block:update'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: [WebBlock::TYPE_BANNER, WebBlock::TYPE_EVENT])]
    #[Groups(['web_block:index', 'web_block:show', 'web_block:create', 'web_block:update'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['web_block:index', 'web_block:show', 'web_block:create', 'web_block:update'])]
    private bool $isActive = false;

    #[ORM\Column]
    #[Groups(['web_block:index', 'web_block:show', 'web_block:create', 'web_block:update'])]
    private ?int $typeId = null;

    #[ORM\Column]
    #[Groups(['web_block:index', 'web_block:show', 'web_block:create', 'web_block:update'])]
    private ?int $order = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(?int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(?int $typeId): static
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
