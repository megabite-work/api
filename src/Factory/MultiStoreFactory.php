<?php

namespace App\Factory;

use App\Entity\MultiStore;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<MultiStore>
 */
final class MultiStoreFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return MultiStore::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->company(),
            'profit' => ['default' => 15, '1' => 5, '2' => 10, '3' => 15, '4' => 20, '5' => 25],
            'barcodeTtn' => self::faker()->isbn13(),
            'nds' => self::faker()->randomElement([5, 10, 15, 20, 25]),
            'owner' => UserFactory::new(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(MultiStore $multiStore): void {})
        ;
    }
}
