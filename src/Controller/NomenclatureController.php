<?php

namespace App\Controller;

use App\Action\Nomenclature\CreateAction;
use App\Action\Nomenclature\DeleteAction;
use App\Action\Nomenclature\IndexAction;
use App\Action\Nomenclature\IsUniqueBarcodeByMultiStoreAction;
use App\Action\Nomenclature\IsUniqueNameByMultiStoreAction;
use App\Action\Nomenclature\ShowAction;
use App\Action\Nomenclature\UpdateAction;
use App\Dto\Nomenclature\RequestDto;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Entity\Nomenclature;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/nomenclatures', format: 'json')]
#[OA\Tag(name: 'Nomenclature')]
class NomenclatureController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, Nomenclature::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:create']], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dtos));
    }

    #[Route(path: '/is-unique-barcode', methods: ['POST'])]
    public function isUniqueBarcode(#[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:is_unique_barcode']])] RequestDto $dto, IsUniqueBarcodeByMultiStoreAction $action): JsonResponse
    {
        return $this->successResponse(['isUnique' => $action($dto)]);
    }

    #[Route(path: '/is-unique-name', methods: ['POST'])]
    public function isUniqueName(#[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:is_unique_name']])] RequestDto $dto, IsUniqueNameByMultiStoreAction $action): JsonResponse
    {
        return $this->successResponse(['isUnique' => $action($dto)]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, Nomenclature::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, Nomenclature::class);
        $action($id);

        return $this->emptyResponse();
    }
}
