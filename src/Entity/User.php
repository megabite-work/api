<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_NAME', fields: ['username'])]
#[Gedmo\SoftDeleteable]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['auth:read', 'user:index', 'user:show', 'user:create', 'user:update', 'multi_store:show', 'user:me', 'cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update', 'cashbox_detail:index',  'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    #[Assert\NotBlank]
    #[Groups(['auth:read', 'user:index', 'user:show', 'user:create', 'user:update', 'multi_store:show', 'user:me'])]
    private ?string $email = null;

    #[ORM\Column(unique: true)]
    #[Groups(['auth:read', 'user:index', 'user:show', 'user:create', 'user:update', 'multi_store:show', 'user:me', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create', 'cashbox_shift:index', 'cashbox_shift:show', 'cashbox_shift:create', 'cashbox_shift:update', 'cashbox_detail:index',  'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    #[Assert\NotBlank]
    private ?string $username = null;

    #[ORM\Column(name: 'qr_code', nullable: true)]
    #[Groups(['user:index', 'user:show', 'user:create', 'user:update', 'multi_store:show', 'user:me'])]
    private ?string $qrCode = null;

    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(targetEntity: MultiStore::class, mappedBy: 'owner', orphanRemoval: true)]
    #[Groups(['user:me'])]
    private Collection $multiStores;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'owner')]
    #[Groups(['user:show', 'user:me'])]
    private Collection $phones;

    #[ORM\OneToMany(targetEntity: UserCredential::class, mappedBy: 'owner', orphanRemoval: true)]
    #[Groups(['user:me'])]
    private Collection $userCredentials;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['user:show', 'user:me'])]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: Store::class, mappedBy: 'workers')]
    #[Groups(['user:me'])]
    private Collection $stores;

    #[ORM\OneToMany(targetEntity: NomenclatureHistory::class, mappedBy: 'owner')]
    private Collection $nomenclatureHistories;

    #[ORM\ManyToMany(targetEntity: MultiStore::class, mappedBy: 'workers')]
    private Collection $workPlaces;

    #[ORM\ManyToMany(targetEntity: WebNomenclature::class)]
    private Collection $favorites;

    #[ORM\OneToMany(targetEntity: CashboxShift::class, mappedBy: 'user')]
    private Collection $cashboxShifts;

    #[ORM\OneToMany(targetEntity: CashboxDetail::class, mappedBy: 'user')]
    private Collection $cashboxDetails;

    #[ORM\ManyToMany(targetEntity: Permission::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'user_permissions')]
    #[Groups(['user:me'])]
    private Collection $permissions;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->stores = new ArrayCollection();
        $this->workPlaces = new ArrayCollection();
        $this->multiStores = new ArrayCollection();
        $this->userCredentials = new ArrayCollection();
        $this->nomenclatureHistories = new ArrayCollection();
        $this->cashboxShifts = new ArrayCollection();
        $this->cashboxDetails = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    #[Groups(['auth:read', 'user:index', 'user:show', 'user:create', 'user:update', 'multi_store:show', 'user:me'])]
    public function getRole(): array
    {
        $roles = $this->getRoles();
        $roleName = array_shift($roles);

        return Role::getRole($roleName);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode): static
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getMultiStores(): Collection
    {
        return $this->multiStores;
    }

    public function addMultiStore(MultiStore $multiStore): static
    {
        if (!$this->multiStores->contains($multiStore)) {
            $this->multiStores->add($multiStore);
            $multiStore->setOwner($this);
        }

        return $this;
    }

    public function removeMultiStore(MultiStore $multiStore): static
    {
        if ($this->multiStores->removeElement($multiStore)) {
            if ($multiStore->getOwner() === $this) {
                $multiStore->setOwner(null);
            }
        }

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
            $phone->setOwner($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            if ($phone->getOwner() === $this) {
                $phone->setOwner(null);
            }
        }

        return $this;
    }

    public function getUserCredentials(): Collection
    {
        return $this->userCredentials;
    }

    public function addUserCredential(UserCredential $userCredential): static
    {
        if (!$this->userCredentials->contains($userCredential)) {
            $this->userCredentials->add($userCredential);
            $userCredential->setOwner($this);
        }

        return $this;
    }

    public function removeUserCredential(UserCredential $userCredential): static
    {
        if ($this->userCredentials->removeElement($userCredential)) {
            if ($userCredential->getOwner() === $this) {
                $userCredential->setOwner(null);
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

    public function getStores(): Collection
    {
        return $this->stores;
    }

    public function addStore(Store $store): static
    {
        if (!$this->stores->contains($store)) {
            $this->stores->add($store);
            $store->addWorker($this);
        }

        return $this;
    }

    public function removeStore(Store $store): static
    {
        if ($this->stores->removeElement($store)) {
            $store->removeWorker($this);
        }

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
            $nomenclatureHistory->setOwner($this);
        }

        return $this;
    }

    public function removeNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if ($this->nomenclatureHistories->removeElement($nomenclatureHistory)) {
            if ($nomenclatureHistory->getOwner() === $this) {
                $nomenclatureHistory->setOwner(null);
            }
        }

        return $this;
    }

    public function getWorkPlaces(): Collection
    {
        return $this->workPlaces;
    }

    public function addWorkPlace(MultiStore $multiStore): static
    {
        if (!$this->workPlaces->contains($multiStore)) {
            $this->workPlaces->add($multiStore);
            $multiStore->addWorker($this);
        }

        return $this;
    }

    public function removeWorkPlace(MultiStore $multiStore): static
    {
        if ($this->workPlaces->removeElement($multiStore)) {
            $multiStore->removeWorker($this);
        }

        return $this;
    }

    public function getCashboxShifts(): Collection
    {
        return $this->cashboxShifts;
    }

    public function addCashboxShift(CashboxShift $cashboxShift): static
    {
        if (!$this->cashboxShifts->contains($cashboxShift)) {
            $this->cashboxShifts->add($cashboxShift);
            $cashboxShift->setUser($this);
        }

        return $this;
    }

    public function removeCashboxShift(CashboxShift $cashboxShift): static
    {
        if ($this->cashboxShifts->removeElement($cashboxShift)) {
            if ($cashboxShift->getUser() === $this) {
                $cashboxShift->setUser(null);
            }
        }

        return $this;
    }

    public function getCashboxDetails(): Collection
    {
        return $this->cashboxDetails;
    }

    public function addCashboxDetail(CashboxDetail $cashboxDetail): static
    {
        if (!$this->cashboxDetails->contains($cashboxDetail)) {
            $this->cashboxDetails->add($cashboxDetail);
            $cashboxDetail->setUser($this);
        }

        return $this;
    }

    public function removeCashboxDetail(CashboxDetail $cashboxDetail): static
    {
        if ($this->cashboxDetails->removeElement($cashboxDetail)) {
            if ($cashboxDetail->getUser() === $this) {
                $cashboxDetail->setUser(null);
            }
        }

        return $this;
    }

    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(WebNomenclature $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
        }

        return $this;
    }

    public function removeFavorite(WebNomenclature $favorite): static
    {
        $this->favorites->removeElement($favorite);

        return $this;
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): static
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }

        return $this;
    }

    public function removePermission(Permission $permission): static
    {
        $this->permissions->removeElement($permission);

        return $this;
    }
}
