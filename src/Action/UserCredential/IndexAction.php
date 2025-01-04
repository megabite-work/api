<?php

namespace App\Action\UserCredential;

use App\Component\Paginator;
use App\Dto\UserCredential\RequestQueryDto;
use App\Repository\UserCredentialRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class IndexAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {
    }

    public function __invoke(UserInterface $user, RequestQueryDto $dto): Paginator
    {
        $userCredentials = $this->repo->findAllUserCredentials($user, $dto);

        return $userCredentials;
    }
}
