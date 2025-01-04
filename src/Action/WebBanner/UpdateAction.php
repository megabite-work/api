<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\RequestDto;
use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): WebBanner
    {
        $entity = $this->em->find(WebBanner::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(WebBanner $entity, RequestDto $dto)
    {
        $typeId = is_numeric($dto->getTypeId()) ? intval($dto->getTypeId()) : $dto->getTypeId();
        $entity->setType($dto->getType())
            ->setTypeId($typeId)
            ->setImage($dto->getImage())
            ->setTitle($dto->getTitle())
            ->setDescription($dto->getDescription())
            ->setDevices($dto->getDevices())
            ->setClickType($dto->getClickType())
            ->setClickMax($dto->getClickMax())
            ->setClickCurrent($dto->getClickCurrent())
            ->setViewType($dto->getViewType())
            ->setViewMax($dto->getViewMax())
            ->setViewCurrent($dto->getViewCurrent())
            ->setBeginAt($dto->getBeginAt())
            ->setIsActive($dto->getIsActive())
            ->setEndAt($dto->getEndAt());

        return $entity;
    }

    private function getWebBannerByType(WebBanner $webBanner, string $type, int $id): WebBanner
    {
        if ('product' === $type) {
            $title = $this->em->find(WebNomenclature::class, $id)?->getTitle();
        } elseif ('category' === $type) {
            $title = $this->em->find(Category::class, $id)?->getName()['ru'];
        }

        $webBanner->setTitle($title);

        return $webBanner;
    }
}
