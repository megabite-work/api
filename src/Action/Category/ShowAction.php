<?php

namespace App\Action\Category;

use App\Dto\Category\IndexDto;
use App\Repository\CategoryRepository;

class ShowAction
{
    public function __construct(private CategoryRepository $repo) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findCategoryByIdWithParentAndChildrens($id));
    }
}
