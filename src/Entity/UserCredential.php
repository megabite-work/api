<?php

namespace App\Entity;

use App\Repository\UserCredentialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserCredentialRepository::class)]
#[ORM\Table(name: 'user_credential')]
#[Gedmo\SoftDeleteable]
class UserCredential
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    public const TYPES = ['company', 'click', 'payme', 'uzum'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user_credential:index', 'user:me'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_credential:index', 'user:me'])]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['user_credential:index', 'user:me'])]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'userCredentials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

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

    public function getValue(): ?array
    {
        return json_decode($this->value, true);
    }

    public function setValue(array $value): static
    {
        $this->value = json_encode($value, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
