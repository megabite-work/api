<?php

namespace App\Entity;

class Role
{
    public const ROLE_ADMIN = 1;
    public const ROLE_DIRECTOR = 2;
    public const ROLE_MANAGER = 3;
    public const ROLE_ACCOUNTANT = 4;
    public const ROLE_STOCK_KEEPER = 5;
    public const ROLE_CASHIER = 6;
    public const ROLE_USER = 7;
    public const ROLE_NAMES = [
        1 => ['ROLE_ADMIN'],
        2 => ['ROLE_DIRECTOR'],
        3 => ['ROLE_MANAGER'],
        4 => ['ROLE_ACCOUNTANT'],
        5 => ['ROLE_STOCK_KEEPER'],
        6 => ['ROLE_CASHIER'],
        7 => ['ROLE_USER'],
    ];

    public static function getRoles(): array
    {
        return [
            [
                'id' => static::ROLE_ADMIN,
                'name' => [
                    'en' => 'Admin',
                    'ru' => 'Админ',
                    'uz' => 'Admin',
                    'uzc' => 'Админ',
                ],
            ],
            [
                'id' => static::ROLE_DIRECTOR,
                'name' => [
                    'en' => 'Director',
                    'ru' => 'Директор',
                    'uz' => 'Direktor',
                    'uzc' => 'Директор',
                ],
            ],
            [
                'id' => static::ROLE_MANAGER,
                'name' => [
                    'en' => 'Manager',
                    'ru' => 'Менежер',
                    'uz' => 'Menejer',
                    'uzc' => 'Менежер',
                ],
            ],
            [
                'id' => static::ROLE_ACCOUNTANT,
                'name' => [
                    'en' => 'Accoutant',
                    'ru' => 'Бухгалтер',
                    'uz' => 'Buxgalter',
                    'uzc' => 'Бухгалтер',
                ],
            ],
            [
                'id' => static::ROLE_STOCK_KEEPER,
                'name' => [
                    'en' => 'Stock keeper',
                    'ru' => 'Кладовшик',
                    'uz' => 'Omborchi',
                    'uzc' => 'Омборчи',
                ],
            ],
            [
                'id' => static::ROLE_CASHIER,
                'name' => [
                    'en' => 'Cashier',
                    'ru' => 'Кассир',
                    'uz' => 'Kassir',
                    'uzc' => 'Кассир',
                ],
            ],
            [
                'id' => static::ROLE_USER,
                'name' => [
                    'en' => 'Client',
                    'ru' => 'Клиент',
                    'uz' => 'Mijoz',
                    'uzc' => 'Мижоз',
                ],
            ],
        ];
    }

    public static function getRoleName(int $role): array
    {
        return static::ROLE_NAMES[$role];
    }

    public static function getRole(string $roleName): array
    {
        $idx = array_keys(array_filter(static::ROLE_NAMES, fn ($role) => $roleName === $role[0]))[0] - 1;

        return static::getRoles()[$idx];
    }
}
