<?php

declare(strict_types=1);

namespace App\Dto\MultiStore;

use App\Dto\Address\IndexDto as AddressDto;
use App\Dto\WebCredential\IndexDto as WebCredentialDto;
use Symfony\Component\Serializer\Attribute\Groups;

final readonly class IndexDto
{
    public function __construct(
        #[Groups(['multi_store:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
        public ?int $id = null,
        #[Groups(['multi_store:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
        public ?string $name = null,
        #[Groups(['multi_store:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
        public string|array|null $profit = null,
        #[Groups(['multi_store:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
        public ?int $barcodeTtn = null,
        #[Groups(['multi_store:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
        public ?int $nds = null,
        #[Groups(['multi_store:show'])]
        /** @var \App\Dto\Store\IndexDto[] */
        public ?array $stores = null,
        #[Groups(['multi_store:show'])]
        public ?WebCredentialDto $webCredential = null,
        #[Groups(['multi_store:show', 'multi_store:update'])]
        public ?AddressDto $address = null,
        #[Groups(['multi_store:show', 'multi_store:update'])]
        /** @var \App\Dto\Phone\IndexDto[] */
        public ?array $phones = null,
        #[Groups(['multi_store:index'])]
        public ?int $storesCount = null,
        #[Groups(['multi_store:index'])]
        public ?int $workersCount = null,
    ) {}
}
