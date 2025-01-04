<?php

namespace App\Entity;

use App\Repository\MoveGlobalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MoveGlobalRepository::class)]
#[ORM\Table(name: 'move_global')]
#[Gedmo\SoftDeleteable]
class MoveGlobal
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['move_global:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['move_global:read', 'move_global:write'])]
    private ?string $status = null;

    #[ORM\Column(name: 'move_detail_id')]
    #[Groups(['move_global:read', 'move_global:write'])]
    private ?int $moveDetailId = null;

    #[ORM\Column(name: 'nomenclature_id')]
    #[Groups(['move_global:read', 'move_global:write'])]
    private ?int $nomenclatureId = null;

    #[ORM\Column(name: 'qty', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['move_global:read', 'move_global:write'])]
    private ?string $qty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getMoveDetailId(): ?int
    {
        return $this->moveDetailId;
    }

    public function setMoveDetailId(int $moveDetailId): static
    {
        $this->moveDetailId = $moveDetailId;

        return $this;
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function setNomenclatureId(int $nomenclatureId): static
    {
        $this->nomenclatureId = $nomenclatureId;

        return $this;
    }

    public function getQty(): ?string
    {
        return $this->qty;
    }

    public function setQty(string $qty): static
    {
        $this->qty = $qty;

        return $this;
    }
}
