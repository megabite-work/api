<?php

namespace App\Action\PaymentType;

use App\Component\EntityNotFoundException;
use App\Dto\PaymentType\RequestDto;
use App\Entity\PaymentType;
use App\Repository\PaymentTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PaymentTypeRepository $repo
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): PaymentType
    {
        $entity = $this->repo->find($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->updatePaymnetType($entity, $dto);

        $this->em->flush();

        return $entity;
    }

    private function updatePaymnetType(PaymentType $entity, RequestDto $dto)
    {
        if ($dto->getNameEn() || $dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $PaymnetTypeName = $entity->getName();
            $name = [
                'en' => $dto->getNameEn() ?? $PaymnetTypeName['en'],
                'ru' => $dto->getNameRu() ?? $PaymnetTypeName['ru'],
                'uz' => $dto->getNameUz() ?? $PaymnetTypeName['uz'],
                'uzc' => $dto->getNameUzc() ?? $PaymnetTypeName['uzc'],
            ];
            $entity->setName($name);
        }
        if ($dto->getType()) {
            $entity->setType($dto->getType());
        }

        return $entity;
    }
}
