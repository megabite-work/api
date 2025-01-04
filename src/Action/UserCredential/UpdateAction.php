<?php

namespace App\Action\UserCredential;

use App\Component\EntityNotFoundException;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
use App\Repository\UserCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserCredentialRepository $repo
    ) {
    }

    public function __invoke(UserInterface $user, int $id, RequestDto $dto): UserCredential
    {
        $userCredential = $this->repo->findOneBy(['id' => $id, 'owner' => $user, 'type' => $dto->getType()]);

        if (null === $userCredential) {
            throw new EntityNotFoundException('not found');
        }

        $userCredential = match ($dto->getType()) {
            'company' => $this->updateCompany($userCredential, $dto),
            'click' => $this->updateClick($userCredential, $dto),
            'payme' => $this->updatePayme($userCredential, $dto),
            'uzum' => $this->updateUzum($userCredential, $dto),
            default => $userCredential
        };

        $this->em->flush();

        return $userCredential;
    }

    private function updateCompany(UserCredential $userCredential, RequestDto $dto): UserCredential
    {
        $company = $userCredential->getValue();
        $company = [
            'inn' => $dto->getInn() ?: $company['inn'],
            'kindOf' => $dto->getKindOf() ?: $company['kindOf'],
            'name' => $dto->getName() ?: $company['name'],
            'director' => $dto->getDirector() ?: $company['director'],
            'address' => $dto->getAddress() ?: $company['address'],
            'phones' => $dto->getPhones() ?: $company['phones'],
            'oferta' => $dto->getOferta(),
        ];

        $userCredential->setValue($company);

        return $userCredential;
    }

    private function updateClick(UserCredential $userCredential, RequestDto $dto): UserCredential
    {
        $click = $userCredential->getValue();
        $click = [
            'serviceId' => $dto->getServiceId() ?: $click['serviceId'],
            'merchantId' => $dto->getMerchantId() ?: $click['merchantId'],
            'secretKey' => $dto->getSecretKey() ?: $click['secretKey'],
            'merchantUserId' => $dto->getMerchantUserId() ?: $click['merchantUserId'],
        ];

        $userCredential->setValue($click);

        return $userCredential;
    }

    private function updatePayme(UserCredential $userCredential, RequestDto $dto): UserCredential
    {
        $payme = $userCredential->getValue();
        $payme = [
            'merchantId' => $dto->getMerchantId() ?: $payme['merchantId'],
        ];

        $userCredential->setValue($payme);

        return $userCredential;
    }

    private function updateUzum(UserCredential $userCredential, RequestDto $dto): UserCredential
    {
        $uzum = $userCredential->getValue();
        $uzum = [
            'xTerminalId' => $dto->getXTerminalId() ?: $uzum['xTerminalId'],
            'xApiKey' => $dto->getXApiKey() ?: $uzum['xApiKey'],
        ];

        $userCredential->setValue($uzum);

        return $userCredential;
    }
}
