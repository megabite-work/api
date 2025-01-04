<?php

namespace App\Entity;

use App\Repository\CounterPartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CounterPartRepository::class)]
#[ORM\Table(name: 'counter_part')]
#[Gedmo\SoftDeleteable]
class CounterPart
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['counter_part:index', 'counter_part:show', 'counter_part:update', 'counter_part:create', 'cashbox_detail:index',  'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'counterParts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column(name: 'inn', nullable: true)]
    #[Groups(['counter_part:index', 'counter_part:show', 'counter_part:update', 'counter_part:create'])]
    private ?string $inn = null;

    #[ORM\Column]
    #[Groups(['counter_part:index', 'counter_part:show', 'counter_part:update', 'counter_part:create', 'cashbox_detail:index',  'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['counter_part:index', 'counter_part:show', 'counter_part:update', 'counter_part:create'])]
    private ?Address $address = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['counter_part:index', 'counter_part:show', 'counter_part:update', 'counter_part:create', 'cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private string|float|null $discount = 0;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'counterPart')]
    #[Groups(['counter_part:index', 'counter_part:show', 'counter_part:update', 'counter_part:create'])]
    private Collection $phones;

    #[ORM\OneToMany(targetEntity: CashboxDetail::class, mappedBy: 'counterPart')]
    private Collection $cashboxDetails;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->cashboxDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(?string $inn): static
    {
        $this->inn = $inn;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): static
    {
        if (!$this->phones->contains($phone)) {
            $this->phones->add($phone);
            $phone->setCounterPart($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            if ($phone->getCounterPart() === $this) {
                $phone->setCounterPart(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, CashboxDetail>
     */
    public function getCashboxDetails(): Collection
    {
        return $this->cashboxDetails;
    }

    public function addCashboxDetail(CashboxDetail $cashboxDetail): static
    {
        if (!$this->cashboxDetails->contains($cashboxDetail)) {
            $this->cashboxDetails->add($cashboxDetail);
            $cashboxDetail->setCounterPart($this);
        }

        return $this;
    }

    public function removeCashboxDetail(CashboxDetail $cashboxDetail): static
    {
        if ($this->cashboxDetails->removeElement($cashboxDetail)) {
            // set the owning side to null (unless already changed)
            if ($cashboxDetail->getCounterPart() === $this) {
                $cashboxDetail->setCounterPart(null);
            }
        }

        return $this;
    }
}
