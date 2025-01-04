<?php

declare(strict_types=1);

namespace App\Dto\WebCredential;

use Symfony\Component\Serializer\Attribute\Groups;

final readonly class IndexDto
{
    public function __construct(
        #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
        public ?int $id = null,
        #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
        public ?string $category = null,
        #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
        public ?int $article = null,
        #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
        public string|array|null $secrets = null,
        #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
        public string|array|null $social = null
    ) {}
}
