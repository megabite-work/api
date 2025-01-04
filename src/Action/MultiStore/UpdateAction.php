<?php

namespace App\Action\MultiStore;

use App\Component\EntityNotFoundException;
use App\Dto\MultiStore\RequestDto;
use App\Entity\MultiStore;
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
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): MultiStore
    {
        $multiStore = $this->updateMultiStore($id, $dto);

        $this->phoneRepository->checkPhoneExistsAndCreate($multiStore, $dto->getPhones());
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($multiStore, $dto);
        $this->em->flush();

        return $multiStore;
    }

    private function updateMultiStore(int $id, RequestDto $dto)
    {
        $multiStore = $this->multiStoreRepository->findMultiStoreByIdWithAddressAndPhones($id);

        if (null === $multiStore) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getName()) {
            $multiStore->setName($dto->getName());
        }
        if ($dto->getProfit()) {
            $multiStore->setProfit($dto->getProfit());
        }
        if ($dto->getNds()) {
            $multiStore->setNds($dto->getNds());
        }

        return $multiStore;
    }
}
