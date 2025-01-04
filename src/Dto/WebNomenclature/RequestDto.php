<?php

namespace App\Dto\WebNomenclature;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_nomenclature:article_attributes'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:article_attribute'])]
        private ?int $multiStoreId,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        private ?int $webNomenclatureId,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        #[Assert\All(constraints: [new Assert\NotBlank(), new Assert\Positive()], groups: ['web_nomenclature:assign'])]
        private ?array $attributeValues,
        #[Groups(['web_nomenclature:create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:create'])]
        private ?int $nomenclatureId,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:create'])]
        private ?string $title,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update', 'web_nomenclature:article_attributes'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:article_attributes'])]
        private ?string $article,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create', 'web_nomenclature:update'])]
        private ?array $images,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        private ?string $description,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        private ?string $document,
        #[Groups(['web_nomenclature:client_article'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article'])]
        private ?string $attributeUz,
        #[Groups(['web_nomenclature:client_article'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article'])]
        private ?string $attributeRu,
        #[Groups(['web_nomenclature:client_article'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article'])]
        private ?string $attributeUzc,
        #[Groups(['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        private ?string $valueUz,
        #[Groups(['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        private ?string $valueRu,
        #[Groups(['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        private ?string $valueUzc,
        #[Groups(['web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_create'])]
        private ?int $clientArticleAttributeId,
        #[Groups(['web_nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['web_nomenclature:update'])]
        private ?bool $isActive = true,
        #[Groups(['web_nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['web_nomenclature:update'])]
        private ?bool $showComment = true,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        private ?bool $remember = false,
    ) {
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getWebNomenclatureId(): ?int
    {
        return $this->webNomenclatureId;
    }

    public function getAttributeValues(): ?array
    {
        return $this->attributeValues;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function isRemember(): bool
    {
        return $this->remember;
    }

    public function getAttributeUz(): ?string
    {
        return $this->attributeUz;
    }

    public function getAttributeRu(): ?string
    {
        return $this->attributeRu;
    }

    public function getAttributeUzc(): ?string
    {
        return $this->attributeUzc;
    }

    public function getAttribute(): ?array
    {
        return ['uz' => $this->getAttributeUz(), 'uzc' => $this->getAttributeUzc(), 'ru' => $this->getAttributeRu()];
    }

    public function getValueUz(): ?string
    {
        return $this->valueUz;
    }

    public function getValueRu(): ?string
    {
        return $this->valueRu;
    }

    public function getValueUzc(): ?string
    {
        return $this->valueUzc;
    }

    public function getValue(): ?array
    {
        return ['uz' => $this->getValueUz(), 'uzc' => $this->getValueUzc(), 'ru' => $this->getValueRu()];
    }

    public function getClientArticleAttributeId(): ?int
    {
        return $this->clientArticleAttributeId;
    }

    public function getShowComment(): ?bool
    {
        return $this->showComment;
    }
}
