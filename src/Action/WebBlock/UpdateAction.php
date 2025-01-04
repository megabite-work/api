<?php

namespace App\Action\WebBlock;

use App\Component\EntityNotFoundException;
use App\Dto\WebBlock\RequestDto;
use App\Entity\WebBlock;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(int $id, RequestDto $dto): WebBlock
    {
        $entity = $this->em->find(WebBlock::class, $id)
            ?? throw new EntityNotFoundException('not found');

        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(WebBlock $entity, RequestDto $dto)
    {
        $entity->setType($dto->getType())
            ->setTypeId($dto->getTypeId())
            ->setIsActive($dto->getIsActive())
            ->setOrder($dto->getOrder());

        return $entity;
    }
}
