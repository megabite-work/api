<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): WebNomenclature
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);

        if (null === $webNomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $webNomenclature = $this->updateWebNomenclature($webNomenclature, $dto);

        $this->em->flush();

        return $webNomenclature;
    }

    private function updateWebNomenclature(WebNomenclature $webNomenclature, RequestDto $dto): WebNomenclature
    {
        if ($dto->getTitle()) {
            $webNomenclature->setTitle($dto->getTitle());
        }
        if ($dto->getArticle()) {
            $webNomenclature->setArticle($dto->getArticle());
        }
        if ($dto->getImages()) {
            $webNomenclature->setImages($dto->getImages());
        }
        if ($dto->getDescription()) {
            $webNomenclature->setDescription($dto->getDescription());
        }
        if ($dto->getDocument()) {
            $webNomenclature->setDocument($dto->getDocument());
        }
        if (null !== $dto->getIsActive()) {
            $webNomenclature->setIsActive($dto->getIsActive());
        }
        if (null !== $dto->getShowComment()) {
            $webNomenclature->setShowComment($dto->getShowComment());
        }

        return $webNomenclature;
    }
}
