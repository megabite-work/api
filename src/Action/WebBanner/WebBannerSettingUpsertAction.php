<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\WebBannerSettingUpsertDto;
use App\Entity\WebBanner;
use App\Entity\WebBannerSetting;
use Doctrine\ORM\EntityManagerInterface;

class WebBannerSettingUpsertAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(WebBannerSettingUpsertDto $dto): array
    {
        if ($dto->getId()) {
            $webBannerSetting = $this->em->getRepository(WebBannerSetting::class)->findOneBy(['id' => $dto->getId()])
            ?? throw new EntityNotFoundException('web banner setting not found', 404);
        } else {
            $webBannerSetting = new WebBannerSetting();
        }

        $this->handle($dto, $webBannerSetting);
        $this->em->flush();

        return [];
    }

    public function handle(WebBannerSettingUpsertDto $dto, WebBannerSetting $webBannerSetting)
    {
        $webBanners = $this->em->getRepository(WebBanner::class)->findBy(['id' => $dto->getWebBannerIds()]);
        $webBannerIds = array_map(function (WebBanner $webBanner) {
            return $webBanner->getId();
        }, $webBanners) ?: throw new EntityNotFoundException('web banner not found', 404);

        $webBannerSetting->setTitle($dto->getTitle())
            ->setAnimation($dto->getAnimation())
            ->setWebBannerIds($webBannerIds)
            ->setMove($dto->getMove())
            ->setDelay($dto->getDelay())
            ->setSpeed($dto->getSpeed());

        $this->em->persist($webBannerSetting);
    }
}
