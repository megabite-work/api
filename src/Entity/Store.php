<?php

namespace App\Entity;

use App\Repository\StoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: StoreRepository::class)]
#[ORM\Table(name: 'store')]
#[Gedmo\SoftDeleteable]
class Store
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['store:index', 'store:show', 'store:create', 'store:update', 'multi_store:show', 'user:me', 'nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create', 'web_nomenclature:show', 'delivery_settings:show', 'delivery_settings:index'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['store:index', 'store:show', 'store:create', 'store:update', 'multi_store:show', 'user:me', 'nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create', 'web_nomenclature:show', 'delivery_settings:show', 'delivery_settings:index'])]
    private ?string $name = null;

    #[ORM\Column(options: ['default' => 1])]
    #[Groups(['store:index', 'store:show', 'store:create', 'store:update', 'multi_store:show', 'user:me', 'web_nomenclature:show'])]
    private bool $isActive = true;

    #[ORM\ManyToOne(inversedBy: 'stores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'store')]
    #[Groups(['store:show', 'store:update', 'web_nomenclature:show'])]
    private Collection $phones;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['store:show', 'store:update', 'web_nomenclature:show'])]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'stores')]
    private Collection $workers;

    #[ORM\OneToMany(targetEntity: NomenclatureHistory::class, mappedBy: 'store')]
    private Collection $nomenclatureHistories;

    #[ORM\OneToMany(targetEntity: StoreNomenclature::class, mappedBy: 'store')]
    private Collection $storeNomenclatures;

    #[ORM\OneToMany(targetEntity: Cashbox::class, mappedBy: 'store')]
    private Collection $cashboxes;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->workers = new ArrayCollection();
        $this->cashboxes = new ArrayCollection();
        $this->nomenclatureHistories = new ArrayCollection();
        $this->storeNomenclatures = new ArrayCollection();
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

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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

    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): static
    {
        if (!$this->phones->contains($phone)) {
            $this->phones->add($phone);
            $phone->setStore($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            if ($phone->getStore() === $this) {
                $phone->setStore(null);
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

    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    #[Groups(['store:index'])]
    public function getWorkersCount(): ?int
    {
        return count($this->workers);
    }

    public function addWorker(User $worker): static
    {
        if (!$this->workers->contains($worker)) {
            $this->workers->add($worker);
        }

        return $this;
    }

    public function removeWorker(User $worker): static
    {
        $this->workers->removeElement($worker);

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
            $nomenclatureHistory->setStore($this);
        }

        return $this;
    }

    public function removeNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if ($this->nomenclatureHistories->removeElement($nomenclatureHistory)) {
            if ($nomenclatureHistory->getStore() === $this) {
                $nomenclatureHistory->setStore(null);
            }
        }

        return $this;
    }

    public function getStoreNomenclatures(): ?Collection
    {
        return $this->storeNomenclatures;
    }

    public function addStoreNomenclature(StoreNomenclature $storeNomenclature): static
    {
        if (!$this->storeNomenclatures->contains($storeNomenclature)) {
            $this->storeNomenclatures->add($storeNomenclature);
            $storeNomenclature->setStore($this);
        }

        return $this;
    }

    public function removeNomenclature(StoreNomenclature $storeNomenclature): static
    {
        if ($this->storeNomenclatures->removeElement($storeNomenclature)) {
            if ($storeNomenclature->getStore() === $this) {
                $storeNomenclature->setStore(null);
            }
        }

        return $this;
    }

    public function getCashboxes(): Collection
    {
        return $this->cashboxes;
    }

    public function addCashbox(Cashbox $cashbox): static
    {
        if (!$this->cashboxes->contains($cashbox)) {
            $this->cashboxes->add($cashbox);
            $cashbox->setStore($this);
        }

        return $this;
    }

    public function removeCashbox(Cashbox $cashbox): static
    {
        if ($this->cashboxes->removeElement($cashbox)) {
            if ($cashbox->getStore() === $this) {
                $cashbox->setStore(null);
            }
        }

        return $this;
    }
}
