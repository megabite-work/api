<?php

namespace App\Entity;

use App\Repository\NomenclatureHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NomenclatureHistoryRepository::class)]
#[ORM\Table(name: 'nomenclature_history')]
#[Gedmo\SoftDeleteable]
class NomenclatureHistory
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Store::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'store_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?Store $store = null;

    #[ORM\ManyToOne(targetEntity: Nomenclature::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'nomenclature_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?Nomenclature $nomenclature = null;

    #[ORM\ManyToOne(targetEntity: ForgiveType::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'forgive_type_id', referencedColumnName: 'id')]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?ForgiveType $forgiveType = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?User $owner = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private float|string|null $qty = 0;

    #[ORM\Column(name: 'oldprice', type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private float|string|null $oldPrice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private float|string|null $price = null;

    #[ORM\Column(name: 'oldprice_course', type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private float|string|null $oldPriceCourse = null;

    #[ORM\Column(name: 'price_course', type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(['nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private float|string|null $priceCourse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): static
    {
        $this->store = $store;

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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getForgiveType(): ?ForgiveType
    {
        return $this->forgiveType;
    }

    public function setForgiveType(?ForgiveType $forgiveType): static
    {
        $this->forgiveType = $forgiveType;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function setQty(?float $qty): static
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
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOldPriceCourse(): ?float
    {
        return $this->oldPriceCourse;
    }

    public function setOldPriceCourse(?float $oldPriceCourse): static
    {
        $this->oldPriceCourse = $oldPriceCourse;

        return $this;
    }

    public function getPriceCourse(): ?float
    {
        return $this->priceCourse;
    }

    public function setPriceCourse(?float $priceCourse): static
    {
        $this->priceCourse = $priceCourse;

        return $this;
    }
}
