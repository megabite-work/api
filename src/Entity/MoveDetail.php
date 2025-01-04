<?php

namespace App\Entity;

use App\Repository\MoveDetailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MoveDetailRepository::class)]
#[ORM\Table(name: 'move_detail')]
#[Gedmo\SoftDeleteable]
class MoveDetail
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['move_detail:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?string $status = null;

    #[ORM\Column(name: 'store_sender_id')]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?int $storeSenderId = null;

    #[ORM\Column(name: 'store_receiver_id')]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?int $storeReceiverId = null;

    #[ORM\Column(name: 'user_sender_id')]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?int $userSenderId = null;

    #[ORM\Column(name: 'user_receiver_id')]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?int $userReceiverId = null;

    #[ORM\Column(name: 'total_qty', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?string $totalQty = null;

    #[ORM\Column(name: 'total_price', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?string $totalPrice = null;

    #[ORM\Column(name: 'total_item')]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?int $totalItem = null;

    #[ORM\Column]
    #[Groups(['move_detail:read', 'move_detail:write'])]
    private ?string $comment = null;

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

    public function getStoreSenderId(): ?int
    {
        return $this->storeSenderId;
    }

    public function setStoreSenderId(int $storeSenderId): static
    {
        $this->storeSenderId = $storeSenderId;

        return $this;
    }

    public function getStoreReceiverId(): ?int
    {
        return $this->storeReceiverId;
    }

    public function setStoreReceiverId(int $storeReceiverId): static
    {
        $this->storeReceiverId = $storeReceiverId;

        return $this;
    }

    public function getUserSenderId(): ?int
    {
        return $this->userSenderId;
    }

    public function setUserSenderId(int $userSenderId): static
    {
        $this->userSenderId = $userSenderId;

        return $this;
    }

    public function getUserReceiverId(): ?int
    {
        return $this->userReceiverId;
    }

    public function setUserReceiverId(int $userReceiverId): static
    {
        $this->userReceiverId = $userReceiverId;

        return $this;
    }

    public function getTotalQty(): ?string
    {
        return $this->totalQty;
    }

    public function setTotalQty(string $totalQty): static
    {
        $this->totalQty = $totalQty;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getTotalItem(): ?int
    {
        return $this->totalItem;
    }

    public function setTotalItem(int $totalItem): static
    {
        $this->totalItem = $totalItem;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}
