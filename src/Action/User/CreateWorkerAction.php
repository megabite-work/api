<?php

namespace App\Action\User;

use App\Component\EntityNotFoundException;
use App\Dto\User\RequestDto;
use App\Entity\MultiStore;
use App\Entity\Role;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateWorkerAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
        private UserRepository $repo,
    ) {
    }

    public function __invoke(RequestDto $dto): User
    {
        $isUniqueEmail = $this->repo->isUniqueEmail($dto->getEmail());
        $isUniqueUsername = $this->repo->isUniqueUsername($dto->getUsername());
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        if (!$isUniqueEmail || !$isUniqueUsername || null === $multiStore) {
            throw new EntityNotFoundException('this email or username already exists', 400);
        }
        if (null == $multiStore) {
            throw new EntityNotFoundException('multi store not found', 404);
        }

        $user = (new User())
            ->setEmail($dto->getEmail())
            ->setUsername($dto->getUsername())
            ->addWorkPlace($multiStore);

        $this->setRole($user, $dto->getRole());
        $this->hashPassword($user, $dto->getPassword());
        $this->setQrCode($user, $dto->getEmail());

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    private function hashPassword(User $user, string $password): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
    }

    private function setQrCode(User $user, string $data): void
    {
        $qrCode = base64_encode($data);
        $user->setQrCode($qrCode);
    }

    private function setRole(User $user, int $role): void
    {
        $roles = array_column(Role::getRoles(), 'id');

        if (!in_array($role, $roles)) {
            throw new EntityNotFoundException('role not found');
        }

        $roleName = Role::getRoleName($role);
        $user->setRoles($roleName);
    }
}
