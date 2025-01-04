<?php

namespace App\Dto\Base;

final readonly class ListResponseDto implements ListResponseDtoInterface
{
    public function __construct(
        public ?array $data = [],
        public ?array $pagination = [],
    ) {}
}
