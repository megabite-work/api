<?php

namespace App\Action\CashboxGlobal;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\CashboxGlobal\IndexDto;
use App\Dto\CashboxGlobal\RequestQueryDto;
use App\Repository\CashboxGlobalRepository;

class IndexAction
{
    public function __construct(
        private CashboxGlobalRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllCashboxGlobalsByCashboxDetail($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
