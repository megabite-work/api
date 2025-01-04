<?php

namespace App\Dto\User;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['user:create', 'user:update', 'unique:email', 'user:create_worker', 'user:create_user'])]
        #[Assert\Email(groups: ['user:create', 'unique:email', 'user:create_worker', 'user:create_user'])]
        #[Assert\NotBlank(groups: ['user:create', 'unique:email', 'user:create_worker', 'user:create_user'])]
        private ?string $email,
        #[Groups(['user:create', 'unique:username', 'user:create_worker', 'user:create_user'])]
        #[Assert\NotBlank(groups: ['user:create', 'unique:username', 'user:create_worker', 'user:create_user'])]
        #[Assert\Length(min: 3, groups: ['user:create', 'unique:username', 'user:create_worker', 'user:create_user'])]
        private ?string $username,
        #[Groups(['user:create', 'change:password', 'user:create_worker', 'user:create_user'])]
        #[Assert\NotBlank(groups: ['user:create', 'change:password', 'user:create_worker', 'user:create_user'])]
        #[Assert\Length(min: 6, groups: ['user:create', 'change:password', 'user:create_worker', 'user:create_user'])]
        private ?string $password,
        #[Groups(['change:password'])]
        #[SerializedName('old_password')]
        #[Assert\NotBlank(groups: ['change:password'])]
        private ?string $oldPassword,
        #[Groups(['change:password'])]
        #[SerializedName('confirm_password')]
        #[Assert\NotBlank(groups: ['change:password'])]
        #[Assert\Length(min: 6, groups: ['change:password'])]
        #[Assert\IdenticalTo(propertyPath: 'password', groups: ['change:password'])]
        private ?string $confirmPassword,
        #[Groups(['user:update'])]
        private ?string $region,
        #[Groups(['user:update'])]
        private ?string $district,
        #[Groups(['user:update'])]
        private ?string $street,
        #[Groups(['user:update'])]
        private ?string $house,
        #[Groups(['user:update'])]
        private ?string $latitude,
        #[Groups(['user:update'])]
        private ?string $longitude,
        #[Groups(['user:update'])]
        private ?array $phones,
        #[Groups(['user:create_worker'])]
        #[Assert\NotBlank(groups: ['user:create_worker'])]
        private ?int $role,
        #[Groups(['user:create_worker'])]
        #[Assert\NotBlank(groups: ['user:create_worker'])]
        private ?int $multiStoreId,
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function getPhones(): array
    {
        return $this->phones ?? [];
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }
}
