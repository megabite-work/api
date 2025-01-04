<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\WebBannerMetrikaUpsertDto;
use App\Entity\WebBanner;
use App\Entity\WebBannerMetrika;
use Doctrine\ORM\EntityManagerInterface;

class WebBannerMetrikaUpsertAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(int $id, WebBannerMetrikaUpsertDto $dto): array
    {
        $webBanner = $this->em->getRepository(WebBanner::class)->findOneBy(['id' => $id, 'isActive' => true])
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $this->upsert($webBanner, $dto);
        $this->em->flush();

        return [];
    }

    private function upsert(WebBanner $webBanner, WebBannerMetrikaUpsertDto $dto): void
    {
        $methodType = 'get'.ucfirst($dto->getType()).'Type';
        $methodMax = 'get'.ucfirst($dto->getType()).'Max';
        $methodCurrent = 'get'.ucfirst($dto->getType()).'Current';
        $webBannerMetrika = $this->em->getRepository(WebBannerMetrika::class)->findOneBy(['webBanner' => $webBanner, 'ip' => $dto->getIp(), 'type' => $dto->getType()]);

        match (true) {
            WebBanner::UNIQUE === $webBanner->$methodType() && null === $webBannerMetrika => $this->handle($webBanner, new WebBannerMetrika(), $dto, $methodMax, $methodCurrent),
            WebBanner::ALL === $webBanner->$methodType() => $this->handle($webBanner, $webBannerMetrika ?? new WebBannerMetrika(), $dto, $methodMax, $methodCurrent),
            default => null,
        };
    }

    private function handle(WebBanner $webBanner, WebBannerMetrika $webBannerMetrika, WebBannerMetrikaUpsertDto $dto, string $methodMax, string $methodCurrent)
    {
        $webBannerMetrika->setIp($dto->getIp())
            ->setType($dto->getType())
            ->setWebBanner($webBanner);

        $this->em->persist($webBannerMetrika);

        $max = $webBanner->$methodMax();
        $current = $webBanner->$methodCurrent() + 1;
        $setMethodCurrent = 'set'.ucfirst($dto->getType()).'Current';

        if ($current < $max) {
            $webBanner->$setMethodCurrent($current);
        } else {
            $webBanner->$setMethodCurrent($current);
            $webBanner->setIsActive(false);
        }
    }
}
