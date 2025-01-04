<?php

namespace App\Entity;

use App\Repository\WebFooterBodyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebFooterBodyRepository::class)]
class WebFooterBody
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?int $webFooterId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?string $about = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?bool $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWebFooterId(): ?int
    {
        return $this->webFooterId;
    }

    public function setWebFooterId(?int $webFooterId): static
    {
        $this->webFooterId = $webFooterId;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): static
    {
        $this->about = $about;

        return $this;
    }
}
