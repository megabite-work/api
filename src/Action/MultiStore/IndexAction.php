<?php

namespace App\Action\MultiStore;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\MultiStore\IndexDto;
use App\Dto\MultiStore\RequestQueryDto;
use App\Repository\MultiStoreRepository;
use Symfony\Bundle\SecurityBundle\Security;

class IndexAction
{
    public function __construct(
        private MultiStoreRepository $repo,
        private Security $security,
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->security->isGranted('ROLE_ADMIN')
            ? $this->repo->findAll()
            : $this->repo->findAllMultiStoresByOwnerWithPagination($this->security->getUser(), $dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromIndexAction($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
