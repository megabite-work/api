<?php

namespace App\Entity;

use App\Repository\CashboxShiftRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CashboxShiftRepository::class)]
#[Gedmo\SoftDeleteable]
class CashboxShift
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxShifts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cashbox $cashbox = null;

    #[ORM\Column]
    #[Groups(['cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update'])]
    private ?int $shiftNumber = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxShifts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update'])]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update'])]
    private ?\DateTimeInterface $closedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCashbox(): ?Cashbox
    {
        return $this->cashbox;
    }

    public function setCashbox(?Cashbox $cashbox): static
    {
        $this->cashbox = $cashbox;

        return $this;
    }

    public function getShiftNumber(): ?int
    {
        return $this->shiftNumber;
    }

    public function setShiftNumber(int $shiftNumber): static
    {
        $this->shiftNumber = $shiftNumber;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->closedAt;
    }

    public function setClosedAt(?\DateTimeInterface $closedAt): static
    {
        $this->closedAt = $closedAt;

        return $this;
    }

    #[Groups(['cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update'])]
    public function getOpenedAt(): ?\DateTimeInterface
    {
        return $this->getCreatedAt();
    }

    #[Groups(['cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update'])]
    public function getWorkingTime(): ?int
    {
        if (null === $this->getClosedAt()) {
            return 0;
        }

        $interval = $this->getCreatedAt()->diff($this->getClosedAt());

        return ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
    }
}
