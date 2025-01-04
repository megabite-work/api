<?php

namespace App\Action\PaymentType;

use App\Component\EntityNotFoundException;
use App\Dto\PaymentType\RequestDto;
use App\Entity\PaymentType;
use App\Repository\PaymentTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PaymentTypeRepository $repo
    ) {
    }

    public function __invoke(RequestDto $dto): PaymentType
    {
        if ($this->repo->findPaymentTypeOrNull($dto)) {
            throw new EntityNotFoundException('this name already exists', 400);
        }

        $entity = $this->create($dto);

        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): PaymentType
    {
        $entity = (new PaymentType())
            ->setName($dto->getName())
            ->setType($dto->getType());

        $this->em->persist($entity);

        return $entity;
    }
}
