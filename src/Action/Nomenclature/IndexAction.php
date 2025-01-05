<?php

namespace App\Action\Nomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Repository\NomenclatureRepository;

class IndexAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $dto->categoryId
            ? $this->repo->findAllNomenclaturesByCategory($dto)
            : $this->repo->findAllNomenclatures($dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
