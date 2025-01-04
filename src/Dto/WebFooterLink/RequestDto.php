<?php

namespace App\Dto\WebFooterLink;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        private int $webFooterBodyId,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        private string $type,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        private string $title,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        private string $link,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        private bool $isActive = true,
    ) {
    }

    public function getWebFooterBodyId(): int
    {
        return $this->webFooterBodyId;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}
