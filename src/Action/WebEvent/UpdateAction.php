<?php

namespace App\Action\WebEvent;

use App\Component\EntityNotFoundException;
use App\Dto\WebEvent\RequestDto;
use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(int $id, RequestDto $dto): WebEvent
    {
        $entity = $this->em->find(WebEvent::class, $id)
            ?? throw new EntityNotFoundException('not found');

        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(WebEvent $entity, RequestDto $dto)
    {
        $entity->setType($dto->getType())
            ->setTypeIds($dto->getTypeIds())
            ->setTitle($dto->getTitle())
            ->setDelay($dto->getDelay())
            ->setMove($dto->getMove())
            ->setAnimation($dto->getAnimation());

        return $entity;
    }
}
