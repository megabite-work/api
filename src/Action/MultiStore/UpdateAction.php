<?php

namespace App\Action\MultiStore;

use App\Dto\MultiStore\IndexDto;
use App\Dto\MultiStore\RequestDto;
use App\Repository\AddressRepository;
use App\Repository\MultiStoreRepository;
use App\Repository\PhoneRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PhoneRepository $phoneRepository,
        private AddressRepository $addressRepository,
        private MultiStoreRepository $multiStoreRepository,
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->multiStoreRepository->findMultiStoreByIdWithAddressAndPhones($id);
        $entity->setName($dto->name ?? $entity->getName())
            ->setProfit($dto->profit ?? $entity->getProfit())
            ->setNds($dto->nds ?? $entity->getNds());
        $this->phoneRepository->checkPhoneExistsAndCreate($entity, $dto->phones);
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($entity, $dto);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
