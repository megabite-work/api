<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\RequestDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebBannerRepository $repo
    ) {
    }

    public function __invoke(RequestDto $dto): WebBanner
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        if (null === $multiStore) {
            throw new EntityNotFoundException('multi store not found', 404);
        }

        $entity = $this->create($multiStore, $dto);
        $this->em->flush();

        return $entity;
    }

    private function create(MultiStore $multiStore, RequestDto $dto): WebBanner
    {
        $typeId = is_numeric($dto->getTypeId()) ? intval($dto->getTypeId()) : $dto->getTypeId();
        $entity = (new WebBanner())
            ->setType($dto->getType())
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
            ->setEndAt($dto->getEndAt())
            ->setMultiStore($multiStore);

        $this->em->persist($entity);

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
