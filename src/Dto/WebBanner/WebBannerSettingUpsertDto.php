<?php

namespace App\Dto\WebBanner;

use Symfony\Component\Validator\Constraints as Assert;

final class WebBannerSettingUpsertDto
{
    public function __construct(
        #[Assert\NotBlank]
        private string $title,
        #[Assert\NotBlank]
        #[Assert\All(constraints: [new Assert\Positive()])]
        private array $webBannerIds,
        #[Assert\NotBlank]
        private string $animation,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ['up', 'right', 'left', 'down'])]
        private string $move,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        private int $delay = 0,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        private int $speed = 0,
        #[Assert\NotBlank(allowNull: true)]
        private ?int $id = null,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getWebBannerIds(): array
    {
        return $this->webBannerIds;
    }

    public function getAnimation(): string
    {
        return $this->animation;
    }

    public function getMove(): string
    {
        return $this->move;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
