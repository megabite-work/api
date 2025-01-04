<?php

namespace App\Entity;

use App\Repository\PermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
class Permission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:me', 'permission:index', 'permission:show', 'permission:create', 'permission:update'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['user:me', 'permission:index', 'permission:show', 'permission:create', 'permission:update'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:me', 'permission:index', 'permission:show', 'permission:create', 'permission:update'])]
    private ?string $icon = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'permissions')]
    private ?Collection $users = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:me', 'permission:index', 'permission:show', 'permission:create', 'permission:update'])]
    private ?string $resource = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:me', 'permission:index', 'permission:show', 'permission:create', 'permission:update'])]
    private ?string $action = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): array
    {
        return json_decode($this->name, true);
    }

    public function setName(array $name): static
    {
        $this->name = json_encode($name, JSON_UNESCAPED_UNICODE);

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

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addPermission($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removePermission($this);
        }

        return $this;
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(string $resource): static
    {
        $this->resource = $resource;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }
}
