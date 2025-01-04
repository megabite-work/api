<?php

namespace App\Action\CashboxShift;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\CashboxShift\IndexDto;
use App\Dto\CashboxShift\RequestQueryDto;
use App\Repository\CashboxShiftRepository;

class IndexAction
{
    public function __construct(
        private CashboxShiftRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllCashboxShiftsByCashbox($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto(
            data: $data,
            pagination: $paginator->getPagination(),
        );
    }
}
