<?php

namespace App\Controller;

use App\Action\CashboxDetail\CreateAction;
use App\Action\CashboxDetail\DeleteAction;
use App\Action\CashboxDetail\IndexAction;
use App\Action\CashboxDetail\ShowAction;
use App\Action\CashboxDetail\UpdateAction;
use App\Dto\CashboxDetail\RequestDto;
use App\Dto\CashboxDetail\RequestQueryDto;
use App\Entity\CashboxDetail;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/cashbox-details', format: 'json')]
#[OA\Tag(name: 'CashboxDetail')]
class CashboxDetailController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['cashbox_detail:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxDetail::class);
        
        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['cashbox_detail:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['cashbox_detail:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxDetail::class);
        
        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, CashboxDetail::class);
        $action($id);
        
        return $this->emptyResponse();
    }
}
