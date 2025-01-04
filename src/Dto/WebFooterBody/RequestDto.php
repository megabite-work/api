<?php

namespace App\Dto\WebFooterBody;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_footer_body:create', 'web_footer_body:update'])]
        #[Assert\NotBlank(groups: ['web_footer_body:create', 'web_footer_body:update'])]
        private int $webFooterId,
        #[Groups(['web_footer_body:create', 'web_footer_body:update'])]
        #[Assert\NotBlank(groups: ['web_footer_body:create', 'web_footer_body:update'])]
        private string $logo,
        #[Groups(['web_footer_body:create', 'web_footer_body:update'])]
        #[Assert\NotBlank(groups: ['web_footer_body:create', 'web_footer_body:update'])]
        private string $about,
        #[Groups(['web_footer_body:create', 'web_footer_body:update'])]
        #[Assert\NotBlank(groups: ['web_footer_body:create', 'web_footer_body:update'])]
        private bool $isActive = true,
    ) {
    }

    public function getWebFooterId(): int
    {
        return $this->webFooterId;
    }

    public function getlogo(): string
    {
        return $this->logo;
    }

    public function getAbout(): string
    {
        return $this->about;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }
}
