<?php

namespace App\Action\CashboxDetail;

use App\Dto\CashboxDetail\IndexDto;
use App\Repository\CashboxDetailRepository;

class ShowAction
{
    public function __construct(
        private CashboxDetailRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findCashboxDetailByIdWithJoined($id));
    }
}
