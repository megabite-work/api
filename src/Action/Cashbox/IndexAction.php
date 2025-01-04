<?php

namespace App\Action\Cashbox;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Cashbox\IndexDto;
use App\Dto\Cashbox\RequestQueryDto;
use App\Repository\CashboxRepository;

class IndexAction
{
    public function __construct(
        private CashboxRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllCashboxesByStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) use ($dto) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
