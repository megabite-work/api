<?php

namespace App\Entity;

use App\Repository\NomenclatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NomenclatureRepository::class)]
#[ORM\Table(name: 'nomenclature')]
#[Gedmo\SoftDeleteable]
class Nomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create', 'cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $mxik = null;

    #[ORM\Column(type: Types::BIGINT)]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create', 'cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private ?int $barcode = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $brand = null;

    #[ORM\Column]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create', 'cashbox_global:index', 'cashbox_global:show', 'cashbox_global:create', 'cashbox_global:update'])]
    private ?string $name = null;

    #[ORM\Column(name: 'oldprice', type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private float|string $oldPrice = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private float|string $price = 0;

    #[ORM\Column(name: 'oldprice_course', type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private float|string $oldPriceCourse = 0;

    #[ORM\Column(name: 'price_course', type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private float|string $priceCourse = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private float|string $nds = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 3, options: ['default' => 0])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private float|string $discount = 0;

    #[ORM\Column(name: 'qr_code', options: ['default' => false])]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'nomenclature:create', 'nomenclature:update', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?bool $qrCode = false;

    #[ORM\ManyToOne(targetEntity: ProviderList::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'provider_id', referencedColumnName: 'id', nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?ProviderList $provider = null;

    #[ORM\ManyToOne(targetEntity: MultiStore::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'multi_store_id', referencedColumnName: 'id', nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['web_nomenclature:index', 'nomenclature:show', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'unit_id', referencedColumnName: 'id', nullable: true)]
    #[Groups(['nomenclature:index', 'nomenclature:show', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?Unit $unit = null;

    #[ORM\OneToMany(targetEntity: NomenclatureHistory::class, mappedBy: 'nomenclature')]
    private Collection $nomenclatureHistories;

    #[ORM\OneToMany(targetEntity: StoreNomenclature::class, mappedBy: 'nomenclature')]
    #[Groups(['nomenclature:show', 'web_nomenclature:show'])]
    private Collection $storeNomenclatures;

    #[ORM\OneToOne(targetEntity: WebNomenclature::class, mappedBy: 'nomenclature')]
    #[Groups(['nomenclature:show'])]
    private ?WebNomenclature $webNomenclature = null;

    public function __construct()
    {
        $this->nomenclatureHistories = new ArrayCollection();
        $this->storeNomenclatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMxik(): ?string
    {
        return $this->mxik;
    }

    public function setMxik(?string $mxik): static
    {
        $this->mxik = $mxik;

        return $this;
    }

    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    public function setBarcode(?int $barcode): static
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getMultiStore(): ?MultiStore
    {
        return $this->multiStore;
    }

    public function setMultiStore(?MultiStore $multiStore): static
    {
        $this->multiStore = $multiStore;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getName(): ?array
    {
        return json_decode($this->name, true);
    }

    public function setName(?array $name): static
    {
        $this->name = json_encode($name, JSON_UNESCAPED_UNICODE);

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

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount ?? 0;

        return $this;
    }

    public function getProvider(): ?ProviderList
    {
        return $this->provider;
    }

    public function setProvider(?ProviderList $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getQrCode(): ?bool
    {
        return $this->qrCode;
    }

    public function setQrCode(?bool $qrCode): static
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getNomenclatureHistories(): ?Collection
    {
        return $this->nomenclatureHistories;
    }

    public function addNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if (!$this->nomenclatureHistories->contains($nomenclatureHistory)) {
            $this->nomenclatureHistories->add($nomenclatureHistory);
            $nomenclatureHistory->setNomenclature($this);
        }

        return $this;
    }

    public function removeNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if ($this->nomenclatureHistories->removeElement($nomenclatureHistory)) {
            if ($nomenclatureHistory->getNomenclature() === $this) {
                $nomenclatureHistory->setNomenclature(null);
            }
        }

        return $this;
    }

    public function getStoreNomenclatures(): ?Collection
    {
        return $this->storeNomenclatures;
    }

    #[Groups(['nomenclature:index', 'nomenclature:show', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show'])]
    public function getTotalQty(): ?int
    {
        return $this->getStoreNomenclatures()->count() ? $this->getStoreNomenclatures()->reduce(fn ($init, $item): float => $item->getQty() + $init, 0) : 0;
    }

    public function addStoreNomenclature(StoreNomenclature $storeNomenclature): static
    {
        if (!$this->storeNomenclatures->contains($storeNomenclature)) {
            $this->storeNomenclatures->add($storeNomenclature);
            $storeNomenclature->setNomenclature($this);
        }

        return $this;
    }

    public function removeStoreNomenclature(StoreNomenclature $storeNomenclature): static
    {
        if ($this->storeNomenclatures->removeElement($storeNomenclature)) {
            if ($storeNomenclature->getNomenclature() === $this) {
                $storeNomenclature->setNomenclature(null);
            }
        }

        return $this;
    }

    public function getWebNomenclature(): ?WebNomenclature
    {
        return $this->webNomenclature;
    }

    public function setWebNomenclature(): static
    {
        $this->webNomenclature->setNomenclature($this);

        return $this;
    }

    #[Groups(['nomenclature:index', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show'])]
    public function getCategoryId(): ?int
    {
        return $this->category->getId();
    }

    #[Groups(['nomenclature:index'])]
    public function getHasWebNomenclature(): bool
    {
        return null !== $this->getWebNomenclature();
    }
}
