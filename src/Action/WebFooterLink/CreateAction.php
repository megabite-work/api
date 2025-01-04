<?php

namespace App\Action\WebFooterLink;

use App\Component\EntityNotFoundException;
use App\Dto\WebFooterLink\RequestDto;
use App\Entity\WebFooterBody;
use App\Entity\WebFooterLink;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(RequestDto $dto): WebFooterLink
    {
        $webFooterBody = $this->em->find(WebFooterBody::class, $dto->getWebFooterBodyId())
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): WebFooterLink
    {
        $entity = (new WebFooterLink())
            ->setWebFooterBodyId($dto->getWebFooterBodyId())
            ->setType($dto->getType())
            ->setTitle($dto->getTitle())
            ->setLink($dto->getLink())
            ->setIsActive($dto->getIsActive());

        $this->em->persist($entity);

        return $entity;
    }
}
