<?php

namespace App\Entity;

use App\Repository\WebBannerMetrikaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebBannerMetrikaRepository::class)]
class WebBannerMetrika
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $ip = null;

    #[ORM\ManyToOne(inversedBy: 'webBanerMetrikas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WebBanner $webBanner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getWebBanner(): ?WebBanner
    {
        return $this->webBanner;
    }

    public function setWebBanner(?WebBanner $webBanner): static
    {
        $this->webBanner = $webBanner;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }
}
