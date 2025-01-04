<?php

namespace App\Entity;

use App\Repository\WebNomenclatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebNomenclatureRepository::class)]
#[ORM\Table(name: 'web_nomenclature')]
#[Gedmo\SoftDeleteable]
class WebNomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update', 'favorite:index'])]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Nomenclature::class, inversedBy: 'webNomenclature')]
    #[ORM\JoinColumn(name: 'nomenclature_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?Nomenclature $nomenclature = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $article = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $images = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $document = null;

    #[ORM\Column(name: 'is_active', options: ['default' => true])]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?bool $isActive = true;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?bool $showComment = true;

    #[ORM\OneToMany(targetEntity: WebAttributeValue::class, mappedBy: 'webNomenclature')]
    private Collection $webAttributeValues;

    #[ORM\OneToMany(targetEntity: ClientArticleAttributeValue::class, mappedBy: 'webNomenclature')]
    private Collection $clientArticleAttributeValues;

    public function __construct()
    {
        $this->webAttributeValues = new ArrayCollection();
        $this->clientArticleAttributeValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->nomenclature;
    }

    public function setNomenclature(Nomenclature $nomenclature): static
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): static
    {
        $this->article = $article;

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

    public function getImages(): ?array
    {
        return json_decode($this->images, true);
    }

    public function setImages(?array $images): static
    {
        $this->images = json_encode($images, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

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

    public function getWebAttributeValues(): Collection
    {
        return $this->webAttributeValues;
    }

    public function addWebAttributeValue(WebAttributeValue $webAttributeValue): static
    {
        if (!$this->webAttributeValues->contains($webAttributeValue)) {
            $this->webAttributeValues->add($webAttributeValue);
            $webAttributeValue->setWebNomenclature($this);
        }

        return $this;
    }

    public function removeWebAttributeValue(WebAttributeValue $webAttributeValue): static
    {
        if ($this->webAttributeValues->removeElement($webAttributeValue)) {
            if ($webAttributeValue->getWebNomenclature() === $this) {
                $webAttributeValue->setWebNomenclature(null);
            }
        }

        return $this;
    }

    public function getClientArticleAttributeValues(): Collection
    {
        return $this->clientArticleAttributeValues;
    }

    public function addClientArticleAttributeValue(ClientArticleAttributeValue $clientArticleAttributeValue): static
    {
        if (!$this->clientArticleAttributeValues->contains($clientArticleAttributeValue)) {
            $this->clientArticleAttributeValues->add($clientArticleAttributeValue);
            $clientArticleAttributeValue->setWebNomenclature($this);
        }

        return $this;
    }

    public function removeClientArticleAttributeValue(ClientArticleAttributeValue $clientArticleAttributeValue): static
    {
        if ($this->clientArticleAttributeValues->removeElement($clientArticleAttributeValue)) {
            if ($clientArticleAttributeValue->getWebNomenclature() === $this) {
                $clientArticleAttributeValue->setWebNomenclature(null);
            }
        }

        return $this;
    }

    public function getShowComment(): ?bool
    {
        return $this->showComment;
    }

    public function setShowComment(?bool $showComment): static
    {
        $this->showComment = $showComment;

        return $this;
    }
}
