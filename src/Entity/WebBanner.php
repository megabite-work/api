<?php

namespace App\Entity;

use App\Repository\WebBannerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebBannerRepository::class)]
#[Gedmo\SoftDeleteable]
class WebBanner
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    public const CLICK = 'click';
    public const VIEW = 'view';
    public const UNIQUE = 'unique';
    public const ALL = 'all';
    public const OFF = 'off';
    public const PC = 'desktop';
    public const MOBILE = 'mobile';
    public const TABLET = 'tablet';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'webBanners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $type_id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $image = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?bool $isActive = true;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $devices = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $clickType = null;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $clickMax = 0;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $clickCurrent = 0;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $viewType = null;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $viewMax = 0;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $viewCurrent = 0;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $beginAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $endAt = null;

    #[ORM\OneToMany(targetEntity: WebBannerMetrika::class, mappedBy: 'webBanner')]
    private Collection $webBanerMetrikas;

    public function __construct()
    {
        $this->webBanerMetrikas = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeId(): ?string
    {
        return $this->type_id;
    }

    public function setTypeId(string $type_id): static
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBeginAt(): ?string
    {
        return $this->beginAt;
    }

    public function setBeginAt(?string $beginAt): static
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getDevices(): ?array
    {
        return json_decode($this->devices);
    }

    public function setDevices(?array $devices): static
    {
        $this->devices = json_encode($devices, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getClickType(): ?string
    {
        return $this->clickType;
    }

    public function setClickType(?string $clickType): static
    {
        $this->clickType = $clickType;

        return $this;
    }

    public function getClickMax(): ?int
    {
        return $this->clickMax;
    }

    public function setClickMax(?int $clickMax): static
    {
        $this->clickMax = $clickMax;

        return $this;
    }

    public function getClickCurrent(): ?int
    {
        return $this->clickCurrent;
    }

    public function setClickCurrent(?int $clickCurrent): static
    {
        $this->clickCurrent = $clickCurrent;

        return $this;
    }

    public function getViewType(): ?string
    {
        return $this->viewType;
    }

    public function setViewType(?string $viewType): static
    {
        $this->viewType = $viewType;

        return $this;
    }

    public function getViewMax(): ?int
    {
        return $this->viewMax;
    }

    public function setViewMax(?int $viewMax): static
    {
        $this->viewMax = $viewMax;

        return $this;
    }

    public function getViewCurrent(): ?int
    {
        return $this->viewCurrent;
    }

    public function setViewCurrent(?int $viewCurrent): static
    {
        $this->viewCurrent = $viewCurrent;

        return $this;
    }

    public function getEndAt(): ?string
    {
        return $this->endAt;
    }

    public function setEndAt(?string $endAt): static
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getWebBanerMetrikas(): Collection
    {
        return $this->webBanerMetrikas;
    }
}
