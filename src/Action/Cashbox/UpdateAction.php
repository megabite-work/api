<?php

namespace App\Action\Cashbox;

use App\Dto\Cashbox\IndexDto;
use App\Dto\Cashbox\RequestDto;
use App\Exception\ErrorException;
use App\Repository\CashboxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxRepository $repo
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->repo->findCashboxByIdWithStore($id);
        $name = $dto->name ? (!$this->repo->hasCashboxByNameAndStore($entity->getStore(), $dto->name) ? $dto->name
            : throw new ErrorException('Cashbox', 'this name already exists', Response::HTTP_BAD_REQUEST)) : $entity->getName();
        $entity->setName($name)
            ->setIsActive($dto->isActive)
            ->setTerminalId($dto->terminalId ?? $entity->getTerminalId())
            ->setShiftNumber($dto->shiftNumber ?? $entity->getShiftNumber())
            ->setZNumber($dto->zNumber ?? $entity->getZNumber())
            ->setXNumber($dto->xNumber ?? $entity->getXNumber())
            ->setWorkplace($dto->workplace ?? $entity->getWorkplace())
            ->setHumoArcusFolder($dto->humoArcusFolder ?? $entity->getHumoArcusFolder());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
