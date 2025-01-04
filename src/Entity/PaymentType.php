<?php

namespace App\Entity;

use App\Repository\PaymentTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PaymentTypeRepository::class)]
#[Gedmo\SoftDeleteable]
class PaymentType
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['payment_type:index', 'payment_type:show', 'payment_type:create', 'payment_type:update', 'cashbox_payment:index', 'cashbox_payment:show'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: ['ordinary', 'e_wallets'])]
    #[Groups(['payment_type:index', 'payment_type:show', 'payment_type:create', 'payment_type:update', 'cashbox_payment:index', 'cashbox_payment:show'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['payment_type:index', 'payment_type:show', 'payment_type:create', 'payment_type:update', 'cashbox_payment:index', 'cashbox_payment:show'])]
    private ?string $name = null;

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

    public function getName(): ?array
    {
        return json_decode($this->name, true);
    }

    public function setName(array $name): static
    {
        $this->name = json_encode($name, JSON_UNESCAPED_UNICODE);

        return $this;
    }
}
