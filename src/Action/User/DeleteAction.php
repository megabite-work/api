<?php

namespace App\Action\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $user = $this->em->find(User::class, $id);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        $this->em->remove($user);
        $this->em->flush();

        return true;
    }
}
