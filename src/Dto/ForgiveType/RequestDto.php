<?php

namespace App\Dto\ForgiveType;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['forgive_type:create', 'forgive_type:update'])]
        #[Assert\NotBlank(groups: ['forgive_type:create'])]
        public ?string $nameUz,
        #[Groups(['forgive_type:create', 'forgive_type:update'])]
        #[Assert\NotBlank(groups: ['forgive_type:create'])]
        public ?string $nameUzc,
        #[Groups(['forgive_type:create', 'forgive_type:update'])]
        #[Assert\NotBlank(groups: ['forgive_type:create'])]
        public ?string $nameRu,
    ) {}

    public function getName(): array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
