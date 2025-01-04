<?php

namespace App\Action\WebFooter;

use App\Component\EntityNotFoundException;
use App\Dto\WebFooter\RequestDto;
use App\Entity\WebFooter;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(int $id, RequestDto $dto): WebFooter
    {
        $entity = $this->em->find(WebFooter::class, $id)
            ?? throw new EntityNotFoundException('not found');

        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(WebFooter $entity, RequestDto $dto)
    {
        $entity->setType($dto->getType())
            ->setTitle($dto->getTitle())
            ->setOrder($dto->getOrder())
            ->setisActive($dto->getisActive());

        return $entity;
    }
}
