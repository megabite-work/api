<?php

namespace App\Dto\Unit;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['unit:index'])]
        #[Assert\Positive(message: 'This value should be positive')]
        private ?int $page = 1,
        #[Groups(['unit:index'])]
        #[Assert\Positive(message: 'This value should be positive')]
        private ?int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }
}
