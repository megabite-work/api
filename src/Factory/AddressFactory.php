<?php

namespace App\Factory;

use App\Entity\Address;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class AddressFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Address::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'region' => self::faker()->country(),
            'district' => self::faker()->city(),
            'street' => self::faker()->streetName(),
            'house' => self::faker()->buildingNumber(),
            'latitude' => self::faker()->latitude(),
            'longitude' => self::faker()->longitude(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Address $address): void {})
        ;
    }
}
