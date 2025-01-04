<?php

namespace App\Action\UserCredential;

use App\Component\EntityNotFoundException;
use App\Entity\UserCredential;
use App\Repository\UserCredentialRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowAction
{
    public function __construct(private UserCredentialRepository $repo)
    {
    }

    public function __invoke(UserInterface $user, int $id): UserCredential
    {
        $userCredential = $this->repo->findOneBy(['id' => $id, 'owner' => $user]);

        if (null === $userCredential) {
            throw new EntityNotFoundException('not found');
        }

        return $userCredential;
    }
}
