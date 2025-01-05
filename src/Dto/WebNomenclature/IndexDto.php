<?php

declare(strict_types=1);

namespace App\Dto\WebNomenclature;

use App\Dto\Nomenclature\IndexDto as NomenclatureDto;
use App\Entity\WebNomenclature;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?NomenclatureDto $nomenclature = null,
        public ?string $article = null,
        public ?string $title = null,
        public string|array|null $images = null,
        public ?string $description = null,
        public ?string $document = null,
        public ?bool $isActive = true,
        public ?bool $showComment = true,
    ) {}

    public static function fromEntity(?WebNomenclature $entity): static
    {
        return $entity
            ? new static(
                $entity->getId(),
                NomenclatureDto::fromEntity($entity->getNomenclature()),
                $entity->getArticle(),
                $entity->getTitle(),
                $entity->getImages(),
                $entity->getDescription(),
                $entity->getDocument(),
                $entity->getIsActive(),
                $entity->getShowComment(),
            )
            : null;
    }

    public static function fromEntityForNomenclature(?WebNomenclature $entity): static
    {
        return $entity
            ? new static(
                $entity->getId(),
                $entity->getArticle(),
                $entity->getTitle(),
                $entity->getImages(),
                $entity->getDescription(),
                $entity->getDocument(),
                $entity->getIsActive(),
                $entity->getShowComment(),
            )
            : null;
    }
}
