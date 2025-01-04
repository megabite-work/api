<?php

namespace App\Entity;

use App\Repository\StoreNomenclatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: StoreNomenclatureRepository::class)]
#[ORM\Table(name: 'store_nomenclature')]
#[Gedmo\SoftDeleteable]
class StoreNomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:show'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Store::class, inversedBy: 'storeNomenclatures')]
    #[ORM\JoinColumn(name: 'store_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['nomenclature:show', 'web_nomenclature:show'])]
    private ?Store $store = null;

    #[ORM\ManyToOne(targetEntity: Nomenclature::class, inversedBy: 'storeNomenclatures')]
    #[ORM\JoinColumn(name: 'nomenclature_id', referencedColumnName: 'id', nullable: false)]
    private ?Nomenclature $nomenclature = null;

    #[ORM\Column(name: 'qty', type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['store_nomenclature:index', 'store_nomenclature:show', 'nomenclature:show', 'web_nomenclature:show'])]
    private float|string $qty = 0;

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

    public function getQty(): float
    {
        return $this->qty;
    }

    public function setQty(float $qty): static
    {
        $this->qty = $qty;

        return $this;
    }
}
