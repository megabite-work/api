<?php

namespace App\Action\User;

use App\Component\EntityNotFoundException;
use App\Dto\User\RequestDto;
use App\Entity\User;
use App\Repository\AddressRepository;
use App\Repository\PhoneRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AddressRepository $addressRepository,
        private PhoneRepository $phoneRepository,
        private UserRepository $repo
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): User
    {
        $user = $this->updateUser($id, $dto);

        $this->phoneRepository->checkPhoneExistsAndCreate($user, $dto->getPhones());
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($user, $dto);
        $this->em->flush();

        return $user;
    }

    private function updateUser(int $id, RequestDto $dto)
    {
        $user = $this->repo->getUserWithAddressAndPhonesByUserId($id);

        if (null === $user) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getEmail()) {
            $user->setEmail($dto->getEmail());
        }

        return $user;
    }
}
