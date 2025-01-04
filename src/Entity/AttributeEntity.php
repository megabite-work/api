<?php

namespace App\Entity;

use App\Repository\AttributeEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: AttributeEntityRepository::class)]
#[Gedmo\SoftDeleteable]
class AttributeEntity
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['attribute:index', 'attribute:show', 'attribute:create', 'attribute:update'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['attribute:index', 'attribute:show', 'attribute:create', 'attribute:update'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'attributes')]
    private Collection $categories;

    #[ORM\OneToMany(targetEntity: AttributeValue::class, mappedBy: 'attribute')]
    private Collection $attributeValues;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->attributeValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }

    public function addAttributeValue(AttributeValue $attributeValue): static
    {
        if (!$this->attributeValues->contains($attributeValue)) {
            $this->attributeValues->add($attributeValue);
            $attributeValue->setAttribute($this);
        }

        return $this;
    }

    public function removeAttributeValue(AttributeValue $attributeValue): static
    {
        if ($this->attributeValues->removeElement($attributeValue)) {
            if ($attributeValue->getAttribute() === $this) {
                $attributeValue->setAttribute(null);
            }
        }

        return $this;
    }
}
