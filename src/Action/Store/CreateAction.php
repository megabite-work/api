<?php

namespace App\Action\Store;

use App\Dto\Store\RequestDto;
use App\Entity\MultiStore;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): Store
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        $store = (new Store())
            ->setName($dto->getName())
            ->setMultiStore($multiStore);

        $this->em->persist($store);
        $this->em->flush();

        return $store;
    }
}
