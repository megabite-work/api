<?php

namespace App\Dto\MultiStore;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['multi_store:create', 'multi_store:update'])]
        #[Assert\NotBlank(groups: ['multi_store:create'])]
        public ?string $name,
        #[Groups(['multi_store:create', 'multi_store:update'])]
        public ?array $profit,
        #[Groups(['multi_store:create', 'multi_store:update'])]
        public ?int $nds,
        #[Groups(['multi_store:update'])]
        public ?string $region,
        #[Groups(['multi_store:update'])]
        public ?string $district,
        #[Groups(['multi_store:update'])]
        public ?string $street,
        #[Groups(['multi_store:update'])]
        public ?string $house,
        #[Groups(['multi_store:update'])]
        public ?string $latitude,
        #[Groups(['multi_store:update'])]
        public ?string $longitude,
        #[Groups(['multi_store:update'])]
        public ?array $phones
    ) {}
}
