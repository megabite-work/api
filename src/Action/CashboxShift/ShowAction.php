<?php

namespace App\Action\CashboxShift;

use App\Dto\CashboxShift\IndexDto;
use App\Repository\CashboxShiftRepository;

class ShowAction
{
    public function __construct(
        private CashboxShiftRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findCashboxShiftById($id));
    }
}
