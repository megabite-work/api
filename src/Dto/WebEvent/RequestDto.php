<?php

namespace App\Dto\WebEvent;

use App\Entity\WebEvent;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_event:create'])]
        #[Assert\NotBlank(groups: ['web_event:create'])]
        private ?int $multiStoreId,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        #[Assert\Choice(choices: [WebEvent::TYPE_CATEGORY, WebEvent::TYPE_PRODUCT], groups: ['web_event:create', 'web_event:update'])]
        private string $type,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        private array $typeIds,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        private string $title,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        private string $animation,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        #[Assert\Choice(choices: ['up', 'right', 'left', 'down'])]
        private string $move,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        #[Assert\PositiveOrZero]
        private int $delay = 0,
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

    public function getTypeIds(): array
    {
        return $this->typeIds;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAnimation(): string
    {
        return $this->animation;
    }

    public function getMove(): string
    {
        return $this->move;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}
