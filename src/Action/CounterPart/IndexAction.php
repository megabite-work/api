<?php

namespace App\Action\CounterPart;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\CounterPart\IndexDto;
use App\Dto\CounterPart\RequestQueryDto;
use App\Repository\CounterPartRepository;

class IndexAction
{
    public function __construct(
        private CounterPartRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllCounterPartsByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
