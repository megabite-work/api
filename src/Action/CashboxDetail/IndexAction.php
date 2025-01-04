<?php

namespace App\Action\CashboxDetail;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\CashboxDetail\IndexDto;
use App\Dto\CashboxDetail\RequestQueryDto;
use App\Entity\CashboxDetail;
use App\Repository\CashboxDetailRepository;

class IndexAction
{
    public function __construct(
        private CashboxDetailRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $pagiantor = $this->repo->findAllCashboxDetailsByCashbox($dto);
        $data = $pagiantor->getData();

        array_walk_recursive($data, function (CashboxDetail &$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $pagiantor->getPagination());
    }
}
