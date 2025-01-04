<?php

namespace App\Controller;

use App\Action\DeliverySettings\CreateAction;
use App\Action\DeliverySettings\DeleteAction;
use App\Action\DeliverySettings\IndexAction;
use App\Action\DeliverySettings\ShowAction;
use App\Action\DeliverySettings\UpdateAction;
use App\Dto\DeliverySettings\RequestDto;
use App\Dto\DeliverySettings\RequestQueryDto;
use App\Entity\DeliverySettings;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/delivery-settings', format: 'json')]
#[OA\Tag(name: 'DeliverySettings')]
class DeliverySettingsController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['delivery_settings:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, DeliverySettings::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['delivery_settings:create']], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dtos), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['delivery_settings:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, DeliverySettings::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, DeliverySettings::class);
        $action($id);

        return $this->emptyResponse();
    }
}
