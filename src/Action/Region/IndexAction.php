<?php

namespace App\Action\Region;

use App\Repository\RegionRepository;

class IndexAction
{
    public function __construct(
        private RegionRepository $repo
    ) {
    }

    public function __invoke(?int $parentId): array
    {
        if (empty($parentId)) {
            $entities = $this->repo->findBy(['parent' => null]);
        } else {
            $parent = $this->repo->find($parentId);
            $entities = $this->repo->findBy(['parent' => $parent]);
        }

        return $entities;
    }
}
