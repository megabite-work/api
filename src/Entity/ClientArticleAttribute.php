<?php

namespace App\Entity;

use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ClientArticleAttributeRepository::class)]
class ClientArticleAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_nomenclature:client_article'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:client_article'])]
    private ?string $article = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_nomenclature:client_article'])]
    private ?string $attribute = null;

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

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getAttribute(): ?array
    {
        return json_decode($this->attribute, true);
    }

    public function setAttribute(array $attribute): static
    {
        $this->attribute = json_encode($attribute, JSON_UNESCAPED_UNICODE);

        return $this;
    }
}
