<?php

namespace App\Dto\WebEvent;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_event:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        private int $multiStoreId,
        #[Groups(['web_event:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['web_event:index'])]
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

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }
}
