<?php

namespace App\Dto\WebFooter;

use App\Entity\WebFooter;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_footer:create'])]
        #[Assert\NotBlank(groups: ['web_footer:create'])]
        private ?int $multiStoreId,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        #[Assert\Choice(choices: [WebFooter::TYPE_ABOUT, WebFooter::TYPE_LINK, WebFooter::TYPE_CONTACT, WebFooter::TYPE_SOCIAL], groups: ['web_footer:create', 'web_footer:update'])]
        private string $type,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        private string $title,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        #[Assert\PositiveOrZero]
        private int $order = 0,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        private bool $isActive = true,
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

    public function getTitle(): string
    {
        return $this->title;
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
