<?php

namespace App\Controller;

use App\Action\CashboxShift\CreateAction;
use App\Action\CashboxShift\DeleteAction;
use App\Action\CashboxShift\IndexAction;
use App\Action\CashboxShift\ShowAction;
use App\Action\CashboxShift\UpdateAction;
use App\Dto\CashboxShift\RequestDto;
use App\Dto\CashboxShift\RequestQueryDto;
use App\Entity\CashboxShift;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/cashbox-shift', format: 'json')]
#[OA\Tag(name: 'CashboxShift')]
class CashboxShiftController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['cashbox_shift:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxShift::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['cashbox_shift:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}/closed', methods: ['PATCH'])]
    public function update(int $id, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxShift::class);

        return $this->successResponse($action($id));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxShift::class);
        $action($id);

        return $this->emptyResponse();
    }
}
