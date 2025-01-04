<?php

namespace App\Dto\WebBlock;

use App\Entity\WebBlock;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_block:create'])]
        #[Assert\NotBlank(groups: ['web_block:create'])]
        private ?int $multiStoreId,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'])]
        #[Assert\Choice(choices: [WebBlock::TYPE_BANNER, WebBlock::TYPE_EVENT], groups: ['web_block:create', 'web_block:update'])]
        private string $type,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'], allowNull: true)]
        private ?int $typeId = null,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'])]
        private bool $isActive = true,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'])]
        #[Assert\PositiveOrZero]
        private int $order = 0,
    ) {
    }

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getOrder(): int
    {
        return $this->order;
    }
}
