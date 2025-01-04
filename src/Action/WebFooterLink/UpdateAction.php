<?php

namespace App\Action\WebFooterLink;

use App\Component\EntityNotFoundException;
use App\Dto\WebFooterLink\RequestDto;
use App\Entity\WebFooterLink;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(int $id, RequestDto $dto): WebFooterLink
    {
        $entity = $this->em->find(WebFooterLink::class, $id)
            ?? throw new EntityNotFoundException('not found');

        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(WebFooterLink $entity, RequestDto $dto)
    {
        $entity->setType($dto->getType())
            ->setWebFooterBodyId($dto->getWebFooterBodyId())
            ->setTitle($dto->getTitle())
            ->setLink($dto->getLink())
            ->setisActive($dto->getisActive());

        return $entity;
    }
}
