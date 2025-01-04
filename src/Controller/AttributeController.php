<?php

namespace App\Controller;

use App\Action\Attribute\AssignAction;
use App\Action\Attribute\CreateAction;
use App\Action\Attribute\DeleteAction;
use App\Action\Attribute\DetachAction;
use App\Action\Attribute\IndexAction;
use App\Action\Attribute\ShowAction;
use App\Action\Attribute\UpdateAction;
use App\Dto\Attribute\RequestDto;
use App\Dto\Attribute\RequestQueryDto;
use App\Entity\AttributeEntity;
use App\Entity\Category;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/attributes', format: 'json')]
#[OA\Tag(name: 'Attribute')]
class AttributeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['attribute:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['attribute:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['attribute:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, AttributeEntity::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}/assign/{category_id<\d+>}', methods: ['POST'])]
    public function assign(int $id, int $categoryId, AssignAction $action): JsonResponse
    {
        $this->existsValidate([$id, $categoryId], [AttributeEntity::class, Category::class]);
        $action($id, $categoryId);
        
        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}/detach/{category_id<\d+>}', methods: ['POST'])]
    public function detach(int $id, int $categoryId, DetachAction $action): JsonResponse
    {
        $this->existsValidate([$id, $categoryId], [AttributeEntity::class, Category::class]);
        $action($id, $categoryId);
        
        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, AttributeEntity::class);
        $action($id);
        
        return $this->emptyResponse();
    }
}
