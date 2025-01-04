<?php

namespace App\Controller;

use App\Action\Value\AssignAction;
use App\Action\Value\CreateAction;
use App\Action\Value\DeleteAction;
use App\Action\Value\DetachAction;
use App\Action\Value\IndexAction;
use App\Action\Value\ShowAction;
use App\Action\Value\UpdateAction;
use App\Dto\Value\RequestDto;
use App\Dto\Value\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/values', format: 'json')]
#[OA\Tag(name: 'Value')]
class ValueController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['value:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['value:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['value:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['value:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['value:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['value:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['value:update']]);
    }

    #[Route('/{id<\d+>}/assign/{attributeId<\d+>}', methods: ['POST'])]
    public function assign(int $id, int $attributeId, AssignAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id, $attributeId)]);
    }

    #[Route('/{id<\d+>}/detach/{attributeId<\d+>}', methods: ['POST'])]
    public function detach(int $id, int $attributeId, DetachAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id, $attributeId)]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
