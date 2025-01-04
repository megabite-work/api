<?php

namespace App\Action\CashboxPayment;

use App\Dto\CashboxPayment\IndexDto;
use App\Repository\CashboxPaymentRepository;

class ShowAction
{
    public function __construct(
        private CashboxPaymentRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        $entity = $this->repo->findCashboxPaymentById($id);

        return IndexDto::fromEntity($entity);
    }
}
