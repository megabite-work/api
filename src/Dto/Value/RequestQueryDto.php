<?php

namespace App\Dto\Value;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['value:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        private int $attributeId,
        #[Groups(['value:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['value:index'])]
        #[Assert\Positive]
        private int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getAttributeId(): int
    {
        return $this->attributeId;
    }
}
