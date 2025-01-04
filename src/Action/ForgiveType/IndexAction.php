<?php

namespace App\Action\ForgiveType;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\ForgiveType\IndexDto;
use App\Dto\ForgiveType\RequestQueryDto;
use App\Repository\ForgiveTypeRepository;

class IndexAction
{
    public function __construct(
        private ForgiveTypeRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllForgiveTypes($dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
