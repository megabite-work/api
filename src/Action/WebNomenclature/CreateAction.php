<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): WebNomenclature
    {
        $nomenclature = $this->em->find(Nomenclature::class, $dto->getNomenclatureId());

        if (null === $nomenclature) {
            throw new EntityNotFoundException('nomenclature not found');
        }

        $webNomenclature = (new WebNomenclature())
            ->setTitle($dto->getTitle())
            ->setNomenclature($nomenclature)
            ->setArticle($dto->getArticle())
            ->setImages($dto->getImages())
            ->setDescription($dto->getDescription())
            ->setDocument($dto->getDocument());

        $this->em->persist($webNomenclature);
        $this->em->flush();

        return $webNomenclature;
    }
}
