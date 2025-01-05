<?php

namespace App\Action\MultiStore;

use App\Dto\MultiStore\IndexDto;
use App\Repository\MultiStoreRepository;

class ShowAction
{
    public function __construct(
        private MultiStoreRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromShowAction($this->repo->findMultiStoreByIdWithAddressAndPhoneAndStore($id));
    }
}
