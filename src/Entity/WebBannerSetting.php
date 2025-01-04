<?php

namespace App\Entity;

use App\Repository\WebBannerSettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebBannerSettingRepository::class)]
class WebBannerSetting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $webBannerIds = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $animation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $move = null;

    #[ORM\Column(nullable: true)]
    private ?int $delay = null;

    #[ORM\Column(nullable: true)]
    private ?int $speed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getWebBannerIds(): ?array
    {
        return json_decode($this->webBannerIds, true);
    }

    public function setWebBannerIds(?array $webBannerIds): static
    {
        $this->webBannerIds = json_encode($webBannerIds, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getAnimation(): ?string
    {
        return $this->animation;
    }

    public function setAnimation(?string $animation): static
    {
        $this->animation = $animation;

        return $this;
    }

    public function getMove(): ?string
    {
        return $this->move;
    }

    public function setMove(?string $move): static
    {
        $this->move = $move;

        return $this;
    }

    public function getDelay(): ?int
    {
        return $this->delay;
    }

    public function setDelay(?int $delay): static
    {
        $this->delay = $delay;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): static
    {
        $this->speed = $speed;

        return $this;
    }
}
