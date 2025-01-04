<?php

namespace App\Entity;

use App\Repository\WebCredentialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebCredentialRepository::class)]
#[ORM\Table(name: 'web_credential')]
#[Gedmo\SoftDeleteable]
class WebCredential
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: MultiStore::class, inversedBy: 'webCredential')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $category = 'supercategory';

    #[ORM\Column(nullable: true, type: Types::BIGINT, options: ['default' => 5952022000000])]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?int $article = 5952022000000;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $secrets = null;

    #[ORM\Column(nullable: true, type: Types::TEXT)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $social = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getArticle(): ?int
    {
        return $this->article;
    }

    public function setArticle(?int $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getSecrets(): ?array
    {
        return json_decode($this->secrets, true);
    }

    public function setSecrets(?array $secrets): static
    {
        $this->secrets = json_encode($secrets, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getSocial(): ?array
    {
        return json_decode($this->social, true);
    }

    public function setSocial(?array $social): static
    {
        $this->social = json_encode($social, JSON_UNESCAPED_UNICODE);

        return $this;
    }
}
