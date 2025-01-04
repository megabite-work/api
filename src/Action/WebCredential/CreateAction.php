<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Dto\WebCredential\RequestDto;
use App\Entity\MultiStore;
use App\Entity\WebCredential;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $multiStoreRepository
    ) {
    }

    public function __invoke(RequestDto $dto): WebCredential
    {
        $multiStore = $this->multiStoreRepository->findMultiStoreByIdWithWebCredential($dto->getMultiStoreId());

        if ($multiStore->getWebCredential()) {
            throw new EntityNotFoundException('already exists', 400);
        }

        $entity = $this->create($multiStore);

        $this->em->flush();

        return $entity;
    }

    private function create(MultiStore $multiStore): WebCredential
    {
        $entity = (new WebCredential())
            ->setMultiStore($multiStore);

        $this->em->persist($entity);

        return $entity;
    }
}
