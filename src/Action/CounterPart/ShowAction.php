<?php

namespace App\Action\CounterPart;

use App\Dto\CounterPart\IndexDto;
use App\Repository\CounterPartRepository;

class ShowAction
{
    public function __construct(
        private CounterPartRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findCounterPartWithAddressAndPhonesById($id));
    }
}
