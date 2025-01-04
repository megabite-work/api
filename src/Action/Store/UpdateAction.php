<?php

namespace App\Action\Store;

use App\Component\EntityNotFoundException;
use App\Dto\Store\RequestDto;
use App\Entity\Store;
use App\Repository\AddressRepository;
use App\Repository\PhoneRepository;
use App\Repository\StoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PhoneRepository $phoneRepository,
        private AddressRepository $addressRepository,
        private StoreRepository $storeRepository,
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): Store
    {
        $store = $this->updateStore($id, $dto);

        $this->phoneRepository->checkPhoneExistsAndCreate($store, $dto->getPhones());
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($store, $dto);
        $this->em->flush();

        return $store;
    }

    private function updateStore(int $id, RequestDto $dto)
    {
        $store = $this->storeRepository->findStoreByIdWithAddressAndPhones($id);

        if (null === $store) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getName()) {
            $store->setName($dto->getName());
        }
        if (null !== $dto->getIsActive()) {
            $store->setIsActive($dto->getIsActive());
        }

        return $store;
    }
}
