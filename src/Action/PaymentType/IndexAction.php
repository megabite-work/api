<?php

namespace App\Action\PaymentType;

use App\Repository\PaymentTypeRepository;

class IndexAction
{
    public function __construct(
        private PaymentTypeRepository $repo
    ) {
    }

    public function __invoke(): array
    {
        $entities = $this->repo->findAll();

        return $entities;
    }
}
