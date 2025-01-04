<?php

namespace App\Entity;

use App\Repository\DeliverySettingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DeliverySettingsRepository::class)]
#[Gedmo\SoftDeleteable]
class DeliverySettings
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    public const DELIVERY_TYPE_FIXED = 'fixed';
    public const DELIVERY_TYPE_FLEXABLE = 'flexable';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['delivery_settings:index', 'delivery_settings:show', 'delivery_settings:update', 'delivery_settings:create'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['delivery_settings:index', 'delivery_settings:show', 'delivery_settings:update', 'delivery_settings:create'])]
    #[Assert\Choice(choices: [DeliverySettings::DELIVERY_TYPE_FIXED, DeliverySettings::DELIVERY_TYPE_FLEXABLE])]
    private string $deliveryType;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['delivery_settings:index', 'delivery_settings:show', 'delivery_settings:update', 'delivery_settings:create'])]
    private string|float $minSum = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['delivery_settings:index', 'delivery_settings:show', 'delivery_settings:update', 'delivery_settings:create'])]
    private string|float $firstKm = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['delivery_settings:index', 'delivery_settings:show', 'delivery_settings:update', 'delivery_settings:create'])]
    private string|float $deliverySum = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['delivery_settings:index', 'delivery_settings:show', 'delivery_settings:update', 'delivery_settings:create'])]
    private string|float $nextKmSum = 0;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['delivery_settings:index', 'delivery_settings:show'])]
    private ?Store $store = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['delivery_settings:index', 'delivery_settings:show'])]
    #[SerializedName('district')]
    private ?Region $region = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    public function setDeliveryType(string $deliveryType): static
    {
        $this->deliveryType = $deliveryType;

        return $this;
    }

    public function getMinSum(): ?float
    {
        return $this->minSum;
    }

    public function setMinSum(float $minSum): static
    {
        $this->minSum = $minSum;

        return $this;
    }

    public function getFirstKm(): ?float
    {
        return $this->firstKm;
    }

    public function setFirstKm(float $firstKm): static
    {
        $this->firstKm = $firstKm;

        return $this;
    }

    public function getDeliverySum(): float
    {
        return $this->deliverySum;
    }

    public function setDeliverySum(float $deliverySum): static
    {
        $this->deliverySum = $deliverySum;

        return $this;
    }

    public function getNextKmSum(): float
    {
        return $this->nextKmSum;
    }

    public function setNextKmSum(float $nextKmSum): static
    {
        $this->nextKmSum = $nextKmSum;

        return $this;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(Store $store): static
    {
        $this->store = $store;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    #[SerializedName('region')]
    #[Groups(['delivery_settings:index', 'delivery_settings:show'])]
    public function getParent(): ?Region
    {
        return $this->getRegion()->getParent();
    }
}
