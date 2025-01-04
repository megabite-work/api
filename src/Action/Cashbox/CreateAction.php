<?php

namespace App\Action\Cashbox;

use App\Dto\Cashbox\IndexDto;
use App\Dto\Cashbox\RequestDto;
use App\Entity\Cashbox;
use App\Entity\Store;
use App\Exception\ErrorException;
use App\Repository\CashboxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $store = $this->em->getReference(Store::class, $dto->storeId);

        if ($this->repo->hasCashboxByNameAndStore($store, $dto->name)) {
            throw new ErrorException('Cashbox', 'this name already exists', Response::HTTP_BAD_REQUEST);
        }

        $entity = (new Cashbox())->setName($dto->name)->setStore($store);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
