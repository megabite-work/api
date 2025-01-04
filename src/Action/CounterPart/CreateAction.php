<?php

namespace App\Action\CounterPart;

use App\Dto\CounterPart\IndexDto;
use App\Dto\CounterPart\RequestDto;
use App\Entity\CounterPart;
use App\Entity\MultiStore;
use App\Exception\ErrorException;
use App\Repository\CounterPartRepository;
use App\Repository\PhoneRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CounterPartRepository $repo,
        private PhoneRepository $phoneRepository,
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $multiStore = $this->em->getReference(MultiStore::class, $dto->multiStoreId);
        $entity = $this->repo->findOneBy(['name' => $dto->name, 'inn' => $dto->inn])
            ? throw new ErrorException('CounterPart', 'already exists')
            : new CounterPart();
        $entity->setName($dto->name)
            ->setInn($dto->inn)
            ->setDiscount($dto->discount)
            ->setMultiStore($multiStore);
        $this->em->persist($entity);
        $this->phoneRepository->checkPhoneExistsAndCreate($entity, $dto->phones);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
