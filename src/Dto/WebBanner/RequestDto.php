<?php

namespace App\Dto\WebBanner;

use App\Entity\WebBanner;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_banner:create'])]
        #[Assert\NotBlank(groups: ['web_banner:create'])]
        private ?int $multiStoreId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: ['product', 'category', 'page', 'link'], groups: ['web_banner:create', 'web_banner:update'])]
        private string $type,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private string $typeId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private string $image,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private string $title,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private string $description,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: [WebBanner::OFF, WebBanner::UNIQUE, WebBanner::ALL], groups: ['web_banner:create', 'web_banner:update'])]
        private string $clickType,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: [WebBanner::OFF, WebBanner::UNIQUE, WebBanner::ALL], groups: ['web_banner:create', 'web_banner:update'])]
        private string $viewType,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\Count(min: 1, max: 3, groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\All(
            constraints: [new Assert\Choice(choices: [WebBanner::PC, WebBanner::MOBILE, WebBanner::TABLET])],
            groups: ['web_banner:create', 'web_banner:update']
        )]
        private array $devices,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private string $beginAt,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'], allowNull: true)]
        private ?string $endAt = null,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        private int $clickMax = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        private int $clickCurrent = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        private int $viewMax = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        private int $viewCurrent = 0,
        #[Groups(['web_banner:update'])]
        #[Assert\Type('bool', groups: ['web_banner:update'])]
        private bool $isActive = true,
    ) {
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTypeId(): string
    {
        return $this->typeId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDevices(): array
    {
        return $this->devices;
    }

    public function getClickType(): string
    {
        return $this->clickType;
    }

    public function getViewType(): string
    {
        return $this->viewType;
    }

    public function getBeginAt(): string
    {
        return $this->beginAt;
    }

    public function getClickMax(): int
    {
        return $this->clickMax;
    }

    public function getClickCurrent(): int
    {
        return $this->clickCurrent;
    }

    public function getViewMax(): int
    {
        return $this->viewMax;
    }

    public function getViewCurrent(): int
    {
        return $this->viewCurrent;
    }

    public function getEndAt(): ?string
    {
        return $this->endAt;
    }
}
