<?php

namespace App\Action\UserCredential;

use App\Component\EntityNotFoundException;
use App\Entity\UserCredential;
use App\Repository\UserCredentialRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowByTypeAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {
    }

    public function __invoke(UserInterface $user, string $type): ?UserCredential
    {
        if (!in_array($type, UserCredential::TYPES)) {
            throw new EntityNotFoundException('Available types: '."'".implode("','", UserCredential::TYPES)."'", 400);
        }

        $userCredential = $this->repo->findUserCredentialByType($user, $type);

        return $userCredential;
    }
}
