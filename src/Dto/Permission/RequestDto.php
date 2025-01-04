<?php

namespace App\Dto\Permission;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        private ?string $nameUz,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        private ?string $nameUzc,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        private ?string $nameRu,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['permission:create', 'permission:update'])]
        private ?string $icon,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        private ?string $resource,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        private ?string $action,
    ) {
    }

    public function getNameUz(): ?string
    {
        return $this->nameUz;
    }

    public function getNameUzc(): ?string
    {
        return $this->nameUzc;
    }

    public function getNameRu(): ?string
    {
        return $this->nameRu;
    }

    public function getName(): ?array
    {
        return ['ru' => $this->getNameRu(), 'uz' => $this->getNameUz(), 'uzc' => $this->getNameUzc()];
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }
}
