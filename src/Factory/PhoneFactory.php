<?php

namespace App\Factory;

use App\Entity\Phone;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class PhoneFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Phone::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'phone' => self::faker()->phoneNumber(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Phone $phone): void {})
        ;
    }
}
