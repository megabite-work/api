<?php

namespace App\Action\Category;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Category\IndexDto;
use App\Dto\Category\RequestQueryDto;
use App\Repository\CategoryRepository;

class IndexAction
{
    public function __construct(
        private CategoryRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $dto->parentId ? $this->repo->findAllCategoriesByParent($dto) : $this->repo->findAllCategoriesParentIsNull($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
