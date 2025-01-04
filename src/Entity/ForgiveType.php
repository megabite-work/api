<?php

namespace App\Entity;

use App\Repository\ForgiveTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ForgiveTypeRepository::class)]
#[ORM\Table(name: 'forgive_type')]
#[Gedmo\SoftDeleteable]
class ForgiveType
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['forgive_type:index', 'forgive_type:show', 'forgive_type:create', 'forgive_type:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['forgive_type:index', 'forgive_type:show', 'forgive_type:create', 'forgive_type:update', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: NomenclatureHistory::class, mappedBy: 'forgiveType')]
    private Collection $nomenclatureHistories;

    public function __construct()
    {
        $this->nomenclatureHistories = new ArrayCollection();
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

    public function getNomenclatureHistories(): ?Collection
    {
        return $this->nomenclatureHistories;
    }

    public function addNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if (!$this->nomenclatureHistories->contains($nomenclatureHistory)) {
            $this->nomenclatureHistories->add($nomenclatureHistory);
            $nomenclatureHistory->setForgiveType($this);
        }

        return $this;
    }

    public function removeNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if ($this->nomenclatureHistories->removeElement($nomenclatureHistory)) {
            if ($nomenclatureHistory->getForgiveType() === $this) {
                $nomenclatureHistory->setForgiveType(null);
            }
        }

        return $this;
    }
}
