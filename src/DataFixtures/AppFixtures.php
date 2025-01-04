<?php

namespace App\DataFixtures;

use App\Factory\AddressFactory;
use App\Factory\MultiStoreFactory;
use App\Factory\PhoneFactory;
use App\Factory\StoreFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(
            5,
            fn (int $i) => [
                'email' => "user$i@gmail.com",
                'username' => "user$i",
                'address' => AddressFactory::new(),
            ]
        );

        MultiStoreFactory::createMany(
            5,
            fn (int $i) => [
                'owner' => UserFactory::random(),
                'address' => AddressFactory::new(),
            ]
        );

        UserFactory::new(['address' => AddressFactory::new()])->admin()->create();

        StoreFactory::createMany(
            5,
            fn (int $i) => [
                'multiStore' => MultiStoreFactory::random(),
                'address' => AddressFactory::new(),
            ]
        );

        PhoneFactory::createMany(
            6,
            fn () => [
                'owner' => UserFactory::random(),
            ]
        );

        PhoneFactory::createMany(
            5,
            fn () => [
                'store' => StoreFactory::random(),
            ]
        );

        PhoneFactory::createMany(
            5,
            fn () => [
                'multiStore' => MultiStoreFactory::random(),
            ]
        );
    }
}
