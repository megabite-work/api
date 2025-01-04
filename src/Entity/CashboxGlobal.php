<?php

namespace App\Entity;

use App\Repository\CashboxGlobalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CashboxGlobalRepository::class)]
#[Gedmo\SoftDeleteable]
class CashboxGlobal
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxGlobals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CashboxDetail $cashboxDetail = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private ?Nomenclature $nomenclature = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $qty = 0;

    #[ORM\Column(name: 'oldprice', type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $oldPrice = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $price = 0;

    #[ORM\Column(name: 'oldprice_course', type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $oldPriceCourse = 0;

    #[ORM\Column(name: 'price_course', type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $priceCourse = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $nds = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $ndsSum = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $discount = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private float|string $discountSum = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCashboxDetail(): ?CashboxDetail
    {
        return $this->cashboxDetail;
    }

    public function setCashboxDetail(?CashboxDetail $cashboxDetail): static
    {
        $this->cashboxDetail = $cashboxDetail;

        return $this;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->nomenclature;
    }

    public function setNomenclature(?Nomenclature $nomenclature): static
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function setQty(float $qty): static
    {
        $this->qty = $qty;

        return $this;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function setOldPrice(?float $oldPrice): static
    {
        $this->oldPrice = $oldPrice ?? 0;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price ?? 0;

        return $this;
    }

    public function getOldPriceCourse(): ?float
    {
        return $this->oldPriceCourse;
    }

    public function setOldPriceCourse(?float $oldPriceCourse): static
    {
        $this->oldPriceCourse = $oldPriceCourse ?? 0;

        return $this;
    }

    public function getPriceCourse(): ?float
    {
        return $this->priceCourse;
    }

    public function setPriceCourse(?float $priceCourse): static
    {
        $this->priceCourse = $priceCourse ?? 0;

        return $this;
    }

    public function getNds(): ?float
    {
        return $this->nds;
    }

    public function setNds(?float $nds): static
    {
        $this->nds = $nds ?? 0;

        return $this;
    }

    public function getNdsSum(): ?float
    {
        return $this->ndsSum;
    }

    public function setNdsSum(?float $ndsSum): static
    {
        $this->ndsSum = $ndsSum ?? 0;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount ?? 0;

        return $this;
    }

    public function getDiscountSum(): ?float
    {
        return $this->discountSum;
    }

    public function setDiscountSum(?float $discountSum): static
    {
        $this->discount = $discountSum ?? 0;

        return $this;
    }
}
