<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UnitRepository::class)]
#[ORM\Table(name: 'unit')]
#[Gedmo\SoftDeleteable]
class Unit
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['unit:index', 'unit:show', 'unit:create', 'unit:update', 'nomenclature:show', 'store:nomenclature', 'web_nomenclature:index', 'web_nomenclature:show'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['unit:index', 'unit:show', 'unit:create', 'unit:update', 'nomenclature:show', 'store:nomenclature', 'web_nomenclature:index', 'web_nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['unit:index', 'unit:show', 'unit:create', 'unit:update', 'nomenclature:show', 'store:nomenclature', 'web_nomenclature:index', 'web_nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?int $code = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['unit:index', 'unit:show', 'unit:create', 'unit:update', 'nomenclature:show', 'store:nomenclature', 'web_nomenclature:index', 'web_nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $icon = null;

    #[ORM\OneToMany(targetEntity: Nomenclature::class, mappedBy: 'unit')]
    private Collection $nomenclatures;

    public function __construct()
    {
        $this->nomenclatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomenclatures(): ?Collection
    {
        return $this->nomenclatures;
    }

    public function addNomenclature(Nomenclature $nomenclature): static
    {
        if (!$this->nomenclatures->contains($nomenclature)) {
            $this->nomenclatures->add($nomenclature);
            $nomenclature->setUnit($this);
        }

        return $this;
    }

    public function removeNomenclature(Nomenclature $nomenclature): static
    {
        if ($this->nomenclatures->removeElement($nomenclature)) {
            if ($nomenclature->getUnit() === $this) {
                $nomenclature->setUnit(null);
            }
        }

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }
}
