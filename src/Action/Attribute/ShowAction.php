<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\IndexDto;
use App\Repository\AttributeEntityRepository;

class ShowAction
{
    public function __construct(
        private AttributeEntityRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
