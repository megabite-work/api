<?php

namespace App\Controller;

use App\Action\Permission\AssignAction;
use App\Action\Permission\CreateAction;
use App\Action\Permission\DeleteAction;
use App\Action\Permission\IndexAction;
use App\Action\Permission\ShowAction;
use App\Action\Permission\UpdateAction;
use App\Dto\Permission\AssignDto;
use App\Dto\Permission\RequestDto;
use App\Dto\Permission\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/permissions', format: 'json')]
#[OA\Tag(name: 'Permission')]
class PermissionController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['permission:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['permission:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['permission:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['permission:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['permission:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['permission:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['permission:update']]);
    }

    #[Route('/assign', methods: ['POST'])]
    public function assign(#[MapRequestPayload(type: AssignDto::class)] array $dtos, AssignAction $action): JsonResponse
    {
        return $this->json($action($dtos), context: ['groups' => ['permission:index']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
