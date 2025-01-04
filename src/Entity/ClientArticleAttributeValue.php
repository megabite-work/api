<?php

namespace App\Entity;

use App\Repository\ClientArticleAttributeValueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;

#[ORM\Entity(repositoryClass: ClientArticleAttributeValueRepository::class)]
class ClientArticleAttributeValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_nomenclature:client_article_value_index', 'web_nomenclature:client_article_value'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClientArticleAttribute $attribute = null;

    #[ORM\ManyToOne(inversedBy: 'clientArticleAttributeValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WebNomenclature $webNomenclature = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_nomenclature:client_article_value_index', 'web_nomenclature:client_article_value'])]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttribute(): ?ClientArticleAttribute
    {
        return $this->attribute;
    }

    #[SerializedName('attribute')]
    #[Groups(['web_nomenclature:client_article_value_index'])]
    public function getAttributeName(): ?array
    {
        return $this->attribute->getAttribute();
    }

    public function setAttribute(?ClientArticleAttribute $attribute): static
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getWebNomenclature(): ?WebNomenclature
    {
        return $this->webNomenclature;
    }

    public function setWebNomenclature(?WebNomenclature $webNomenclature): static
    {
        $this->webNomenclature = $webNomenclature;

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
}
