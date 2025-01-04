<?php

namespace App\Controller;

use App\Action\MultiStore\CreateAction;
use App\Action\MultiStore\DeleteAction;
use App\Action\MultiStore\IndexAction;
use App\Action\MultiStore\ShowAction;
use App\Action\MultiStore\UpdateAction;
use App\Dto\MultiStore\RequestDto;
use App\Dto\MultiStore\RequestQueryDto;
use App\Entity\MultiStore;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/multi-stores', format: 'json')]
#[IsGranted('ROLE_DIRECTOR', statusCode: 403, message: 'Access Denied')]
#[OA\Tag(name: 'MultiStore')]
class MultiStoreController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['multi_store:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, MultiStore::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['multi_store:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto));
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['multi_store:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, MultiStore::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, MultiStore::class);
        $action($id);

        return $this->emptyResponse();
    }
}
