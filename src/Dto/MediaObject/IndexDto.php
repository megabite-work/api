<?php

declare(strict_types=1);

namespace App\Dto\MediaObject;

final readonly class IndexDto
{
    public function __construct(
        public readonly ?string $filePath = null,
    ) {}
}
