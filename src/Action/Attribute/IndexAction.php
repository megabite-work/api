<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\IndexDto;
use App\Dto\Attribute\RequestQueryDto;
use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Repository\AttributeEntityRepository;

class IndexAction
{
    public function __construct(
        private AttributeEntityRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllAttributesByCategory($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
