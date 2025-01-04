<?php

namespace App\Action\ForgiveType;

use App\Dto\ForgiveType\IndexDto;
use App\Repository\ForgiveTypeRepository;

class ShowAction
{
    public function __construct(
        private ForgiveTypeRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findForgiveTypeById($id));
    }
}
