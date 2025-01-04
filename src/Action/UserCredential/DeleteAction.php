<?php

namespace App\Action\UserCredential;

use App\Component\EntityNotFoundException;
use App\Repository\UserCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserCredentialRepository $repo
    ) {
    }

    public function __invoke(UserInterface $user, int $id): bool
    {
        $userCredential = $this->repo->findOneBy(['id' => $id, 'owner' => $user]);

        if (null === $userCredential) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($userCredential);
        $this->em->flush();

        return true;
    }
}
