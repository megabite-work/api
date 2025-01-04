<?php

namespace App\Entity;

use App\Repository\WebEventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WebEventRepository::class)]
class WebEvent
{
    public const TYPE_CATEGORY = 'category';
    public const TYPE_PRODUCT = 'product';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Choice(choices: [WebEvent::TYPE_CATEGORY, WebEvent::TYPE_PRODUCT, null])]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?string $typeIds = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?string $animation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?string $move = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_event:index', 'web_event:show', 'web_event:create', 'web_event:update'])]
    private ?int $delay = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(?int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeIds(): ?array
    {
        return json_decode($this->typeIds, true);
    }

    public function setTypeIds(?array $typeIds): static
    {
        $this->typeIds = json_encode($typeIds, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getAnimation(): ?string
    {
        return $this->animation;
    }

    public function setAnimation(?string $animation): static
    {
        $this->animation = $animation;

        return $this;
    }

    public function getMove(): ?string
    {
        return $this->move;
    }

    public function setMove(?string $move): static
    {
        $this->move = $move;

        return $this;
    }

    public function getDelay(): ?int
    {
        return $this->delay;
    }

    public function setDelay(?int $delay): static
    {
        $this->delay = $delay;

        return $this;
    }
}
