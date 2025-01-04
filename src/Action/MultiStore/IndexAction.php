<?php

namespace App\Action\MultiStore;

use App\Component\CurrentUser;
use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\MultiStore\IndexDto;
use App\Dto\MultiStore\RequestQueryDto;
use App\Entity\User;
use App\Repository\MultiStoreRepository;
use AutoMapper\AutoMapperInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class IndexAction
{
    public function __construct(
        private MultiStoreRepository $repo,
        private Security $security,
        private readonly AutoMapperInterface $mapper,
        /** @var Serializer */
        private SerializerInterface $serializer,
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->security->isGranted('ROLE_ADMIN')
            ? $this->repo->findAll()
            : $this->repo->findAllMultiStoresByOwnerWithPagination($this->security->getUser(), $dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $context = ['groups' => ['multi_store:index'], 'circular_reference_limit' => 0];
            $entity = $this->serializer->denormalize(data: $this->serializer->normalize(data: $entity, context: $context), type: IndexDto::class, context: $context);
            // $entity = $this->mapper->map($entity, IndexDto::class, ['groups' => ['multi_store:index']]);
        });

        dd($data);

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
