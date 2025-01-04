<?php

namespace App\Dto\UserCredential;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        private ?string $inn,
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        private ?string $kindOf,
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        private ?string $name,
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        private ?string $director,
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        private ?string $address,
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        private ?array $phones,
        #[Groups(['user_credential:click_create', 'user_credential:click_update'])]
        #[Assert\NotBlank(groups: ['user_credential:click_create'])]
        private ?string $serviceId,
        #[Groups(['user_credential:click_create', 'user_credential:click_update', 'user_credential:payme_create', 'user_credential:payme_update'])]
        #[Assert\NotBlank(groups: ['user_credential:click_create', 'user_credential:payme_create'])]
        private ?string $merchantId,
        #[Groups(['user_credential:click_create', 'user_credential:click_update'])]
        #[Assert\NotBlank(groups: ['user_credential:click_create'])]
        private ?string $secretKey,
        #[Groups(['user_credential:click_create', 'user_credential:click_update'])]
        #[Assert\NotBlank(groups: ['user_credential:click_create'])]
        private ?string $merchantUserId,
        #[Groups(['user_credential:uzum_create', 'user_credential:uzum_update'])]
        #[Assert\NotBlank(groups: ['user_credential:uzum_create'])]
        private ?string $xTerminalId,
        #[Groups(['user_credential:uzum_create', 'user_credential:uzum_update'])]
        #[Assert\NotBlank(groups: ['user_credential:uzum_create'])]
        private ?string $xApiKey,
        #[Groups(['user_credential:company_create', 'user_credential:company_update'])]
        #[Assert\NotBlank(groups: ['user_credential:company_create'])]
        #[Assert\Type(['bool'], groups: ['user_credential:company_create'])]
        private bool $oferta = false,
        private ?string $type = null
    ) {
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getValue(): array
    {
        $value = [];
        if ($this->isCompany()) {
            $value = $this->getCompany();
        } elseif ($this->isClick()) {
            $value = $this->getClick();
        } elseif ($this->isPayme()) {
            $value = $this->getPayme();
        } elseif ($this->isUzum()) {
            $value = $this->getUzum();
        }

        return $value;
    }

    private function getCompany(): array
    {
        return [
            'inn' => $this->inn,
            'kindOf' => $this->kindOf,
            'name' => $this->name,
            'director' => $this->director,
            'address' => $this->address,
            'phones' => $this->phones,
            'oferta' => $this->oferta,
        ];
    }

    private function getClick(): array
    {
        return [
            'serviceId' => $this->serviceId,
            'merchantId' => $this->merchantId,
            'secretKey' => $this->secretKey,
            'merchantUserId' => $this->merchantUserId,
        ];
    }

    private function getPayme(): array
    {
        return [
            'merchantId' => $this->merchantId,
        ];
    }

    private function getUzum(): array
    {
        return [
            'xTerminalId' => $this->xTerminalId,
            'xApiKey' => $this->xApiKey,
        ];
    }

    private function isCompany(): bool
    {
        return $this->inn && $this->address && $this->director && $this->name && $this->phones && null !== $this->oferta;
    }

    private function isClick(): bool
    {
        return $this->serviceId && $this->merchantId && $this->secretKey && $this->merchantUserId;
    }

    private function isPayme(): bool
    {
        return !$this->serviceId && $this->merchantId && !$this->secretKey && !$this->merchantUserId;
    }

    private function isUzum(): bool
    {
        return $this->xTerminalId && $this->xApiKey;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function getKindOf(): ?string
    {
        return $this->kindOf;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPhones(): ?array
    {
        return $this->phones;
    }

    public function getOferta(): bool
    {
        return $this->oferta;
    }

    public function getServiceId(): ?string
    {
        return $this->serviceId;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function getSecretKey(): ?string
    {
        return $this->secretKey;
    }

    public function getMerchantUserId(): ?string
    {
        return $this->merchantUserId;
    }

    public function getXTerminalId(): ?string
    {
        return $this->xTerminalId;
    }

    public function getXApiKey(): ?string
    {
        return $this->xApiKey;
    }
}
