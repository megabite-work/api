<?php

namespace App\Action\CashboxGlobal;

use App\Dto\CashboxGlobal\IndexDto;
use App\Repository\CashboxGlobalRepository;

class ShowAction
{
    public function __construct(
        private CashboxGlobalRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findCashboxGlobalById($id));
    }
}
