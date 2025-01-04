<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Repository\PermissionRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PermissionVoter extends Voter
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject ? true : false;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $this->permissionRepository->hasPermissionsByUser($user->getId(), $subject, $attribute);
    }
}
