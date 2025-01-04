<?php

namespace App\Controller;

use App\Action\CashboxGlobal\CreateAction;
use App\Action\CashboxGlobal\DeleteAction;
use App\Action\CashboxGlobal\IndexAction;
use App\Action\CashboxGlobal\ShowAction;
use App\Action\CashboxGlobal\UpdateAction;
use App\Dto\CashboxGlobal\RequestDto;
use App\Dto\CashboxGlobal\RequestQueryDto;
use App\Dto\CashboxGlobal\UpdateRequestDto;
use App\Entity\CashboxGlobal;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/cashbox-globals', format: 'json')]
#[OA\Tag(name: 'CashboxGlobal')]
class CashboxGlobalController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['cashbox_global:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxGlobal::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['cashbox_global:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['cashbox_global:update']])] UpdateRequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxGlobal::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxGlobal::class);
        $action($id);

        return $this->emptyResponse();
    }
}
