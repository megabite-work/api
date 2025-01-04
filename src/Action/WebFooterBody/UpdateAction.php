<?php

namespace App\Action\WebFooterBody;

use App\Component\EntityNotFoundException;
use App\Dto\WebFooterBody\RequestDto;
use App\Entity\WebFooterBody;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(int $id, RequestDto $dto): WebFooterBody
    {
        $entity = $this->em->find(WebFooterBody::class, $id)
            ?? throw new EntityNotFoundException('not found');

        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(WebFooterBody $entity, RequestDto $dto)
    {
        $entity->setWebFooterId($dto->getWebFooterId())
            ->setLogo($dto->getLogo())
            ->setAbout($dto->getAbout())
            ->setIsActive($dto->getIsActive());

        return $entity;
    }
}
