<?php

namespace App\Action\DeliverySettings;

use App\Dto\DeliverySettings\IndexDto;
use App\Repository\DeliverySettingsRepository;

class ShowAction
{
    public function __construct(
        private DeliverySettingsRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findDeliverySettingsByIdWithStoreAndRegion($id), true);
    }
}
