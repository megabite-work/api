<?php

namespace App\Action\WebFooterBody;

use App\Component\EntityNotFoundException;
use App\Dto\WebFooterBody\RequestDto;
use App\Entity\WebFooter;
use App\Entity\WebFooterBody;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(RequestDto $dto): WebFooterBody
    {
        $webFooter = $this->em->find(WebFooter::class, $dto->getWebFooterId())
            ?? throw new EntityNotFoundException('web footer not found', 404);

        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): WebFooterBody
    {
        $entity = (new WebFooterBody())
            ->setWebFooterId($dto->getWebFooterId())
            ->setLogo($dto->getLogo())
            ->setAbout($dto->getAbout())
            ->setIsActive($dto->getIsActive());

        $this->em->persist($entity);

        return $entity;
    }
}
