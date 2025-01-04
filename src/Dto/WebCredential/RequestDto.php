<?php

namespace App\Dto\WebCredential;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_credential:create'])]
        #[Assert\NotBlank(groups: ['web_credential:create'])]
        private ?int $multiStoreId,
        #[Groups(['web_credential:update'])]
        private ?string $category,
        #[Groups(['web_credential:update'])]
        private ?array $secrets,
        #[Groups(['web_credential:update'])]
        private ?array $social,
    ) {
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    public function getSocial(): ?array
    {
        return $this->social;
    }
}
