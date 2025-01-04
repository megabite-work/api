<?php

namespace App\Action\PaymentType;

use App\Component\EntityNotFoundException;
use App\Entity\PaymentType;
use App\Repository\PaymentTypeRepository;

class ShowAction
{
    public function __construct(private PaymentTypeRepository $repo)
    {
    }

    public function __invoke(int $id): PaymentType
    {
        $entity = $this->repo->find($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
