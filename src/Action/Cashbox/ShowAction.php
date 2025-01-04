<?php

namespace App\Action\Cashbox;

use App\Dto\Cashbox\IndexDto;
use App\Repository\CashboxRepository;

class ShowAction
{
    public function __construct(private CashboxRepository $repo) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findCashboxByIdWithStore($id));
    }
}
