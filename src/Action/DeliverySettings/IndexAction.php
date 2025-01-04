<?php

namespace App\Action\DeliverySettings;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\DeliverySettings\IndexDto;
use App\Dto\DeliverySettings\RequestQueryDto;
use App\Repository\DeliverySettingsRepository;

class IndexAction
{
    public function __construct(
        private DeliverySettingsRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = match (true) {
            $dto->storeId && $dto->regionId => $this->repo->findAllDeliverySettingsByStoreAndRegion($dto),
            $dto->storeId !== null => $this->repo->findAllDeliverySettingsByStore($dto),
            $dto->regionId !== null => $this->repo->findAllDeliverySettingsByRegion($dto),
            default => $this->repo->findAllDeliverySettingsByMultiStore($dto)
        };
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity, true);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
