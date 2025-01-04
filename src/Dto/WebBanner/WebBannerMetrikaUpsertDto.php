<?php

namespace App\Dto\WebBanner;

use App\Entity\WebBanner;
use Symfony\Component\Validator\Constraints as Assert;

final class WebBannerMetrikaUpsertDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Choice(choices: [WebBanner::CLICK, WebBanner::VIEW])]
        private string $type,
        #[Assert\Ip(version: Assert\Ip::ALL)]
        private string $ip,
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
