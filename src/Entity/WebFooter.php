<?php

namespace App\Entity;

use App\Repository\WebFooterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WebFooterRepository::class)]
class WebFooter
{
    public const TYPE_ABOUT = 'about';
    public const TYPE_LINK = 'link';
    public const TYPE_CONTACT = 'contact';
    public const TYPE_SOCIAL = 'social';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_footer:index', 'web_footer:show', 'web_footer:create', 'web_footer:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_footer:index', 'web_footer:show', 'web_footer:create', 'web_footer:update'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_footer:index', 'web_footer:show', 'web_footer:create', 'web_footer:update'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: [WebFooter::TYPE_ABOUT, WebFooter::TYPE_LINK, WebFooter::TYPE_CONTACT, WebFooter::TYPE_SOCIAL])]
    #[Groups(['web_footer:index', 'web_footer:show', 'web_footer:create', 'web_footer:update'])]
    private ?string $type = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_footer:index', 'web_footer:show', 'web_footer:create', 'web_footer:update'])]
    private ?bool $isActive = true;

    #[ORM\Column]
    #[Groups(['web_footer:index', 'web_footer:show', 'web_footer:create', 'web_footer:update'])]
    private ?int $order = null;

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

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
