<?php

namespace App\Action\Favorite;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Repository\UserRepository;
use App\Repository\WebNomenclatureRepository;

class IndexAction
{
    public function __construct(
        private WebNomenclatureRepository $webNomenclatureRepository,
        private UserRepository $userRepository
    ) {}

    public function __invoke(int $id): ListResponseDtoInterface
    {
        $favoriteIds = $this->userRepository->findAllUserFavoriteIds($id);
        $paginator = $this->webNomenclatureRepository->findAllUserFavoritesByIds($favoriteIds);

        return new ListResponseDto($paginator->getData(), $paginator->getPagination());
    }
}
