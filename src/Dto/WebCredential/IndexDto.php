<?php

declare(strict_types=1);

namespace App\Dto\WebCredential;

use App\Entity\WebCredential;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $category = null,
        public ?int $article = null,
        public string|array|null $secrets = null,
        public string|array|null $social = null
    ) {}

    public static function fromEntity(WebCredential $entity): static
    {
        return new static(
            id: $entity->getId(),
            category: $entity->getCategory(),
            article: $entity->getArticle(),
            secrets: $entity->getSecrets(),
            social: $entity->getSocial(),
        );
    }
}
