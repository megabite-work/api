<?php

namespace App\Action\WebBanner;

use App\Entity\WebBanner;
use App\Repository\WebBannerSettingRepository;
use Doctrine\ORM\EntityManagerInterface;

class WebBannerSettingIndexAction
{
    public function __construct(private WebBannerSettingRepository $repo, private EntityManagerInterface $em)
    {
    }

    public function __invoke(?int $id = null): array
    {
        if ($id) {
            $webBannerSetting = $this->repo->find($id);

            return [
                'id' => $webBannerSetting->getId(),
                'title' => $webBannerSetting->getTitle(),
                'webBannerIds' => $webBannerSetting->getWebBannerIds(),
                'webBanners' => $this->em->getRepository(WebBanner::class)->findBy(['id' => $webBannerSetting->getWebBannerIds()]),
                'animation' => $webBannerSetting->getAnimation(),
                'move' => $webBannerSetting->getMove(),
                'delay' => $webBannerSetting->getDelay(),
                'speed' => $webBannerSetting->getSpeed(),
            ];
        }

        return $this->repo->findAll();
    }
}
