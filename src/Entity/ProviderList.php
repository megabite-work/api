<?php

namespace App\Entity;

use App\Repository\ProviderListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProviderListRepository::class)]
#[ORM\Table(name: 'provider_list')]
#[Gedmo\SoftDeleteable]
class ProviderList
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['provider_list:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['provider_list:read', 'provider_list:write', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['provider_list:read', 'provider_list:write', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?string $value = null;

    #[ORM\OneToMany(targetEntity: Nomenclature::class, mappedBy: 'provider')]
    private Collection $nomenclatures;

    public function __construct()
    {
        $this->nomenclatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getvalue(): ?string
    {
        return $this->value;
    }

    public function setvalue(string $value): static
    {
        $this->value = $value;

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
            $nomenclature->setProvider($this);
        }

        return $this;
    }

    public function removeNomenclature(Nomenclature $nomenclature): static
    {
        if ($this->nomenclatures->removeElement($nomenclature)) {
            if ($nomenclature->getProvider() === $this) {
                $nomenclature->setProvider(null);
            }
        }

        return $this;
    }
}
