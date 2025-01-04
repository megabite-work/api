<?php

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class UserFactory extends PersistentProxyObjectFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public static function class(): string
    {
        return User::class;
    }

    public function admin(): self
    {
        return $this->with([
            'username' => 'admin',
            'roles' => ['ROLE_ADMIN'],
        ]);
    }

    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->unique()->safeEmail(),
            'username' => self::faker()->text(),
            'qrCode' => base64_encode(self::faker()->unique()->safeEmail()),
            'password' => 'secret',
            'roles' => ['ROLE_DIRECTOR'],
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            ->afterInstantiate(function (User $user, array $attributes): void {
                $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            });
    }
}
