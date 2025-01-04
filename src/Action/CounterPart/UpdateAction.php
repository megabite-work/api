<?php

namespace App\Action\CounterPart;

use App\Dto\CounterPart\IndexDto;
use App\Dto\CounterPart\RequestDto;
use App\Entity\CounterPart;
use App\Repository\AddressRepository;
use App\Repository\PhoneRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PhoneRepository $phoneRepository,
        private AddressRepository $addressRepository,
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(CounterPart::class, $id);
        $entity->setName($dto->name ?? $entity->getName())
            ->setInn($dto->inn ?? $entity->getInn())
            ->setDiscount($dto->discount ?? $entity->getDiscount());
        $this->phoneRepository->checkPhoneExistsAndCreate($entity, $dto->phones);
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($entity, $dto);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
