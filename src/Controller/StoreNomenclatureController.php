<?php

namespace App\Controller;

use App\Action\StoreNomenclature\CreateAction;
use App\Action\StoreNomenclature\DeleteAction;
use App\Action\StoreNomenclature\IndexAction;
use App\Action\StoreNomenclature\ShowAction;
use App\Action\StoreNomenclature\UpdateAction;
use App\Dto\StoreNomenclature\RequestDto;
use App\Dto\StoreNomenclature\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/stores', format: 'json')]
#[OA\Tag(name: 'StoreNomenclature')]
class StoreNomenclatureController extends AbstractController
{
    #[Route(path: '/{storeId<\d+>}/nomenclatures', methods: ['GET'])]
    public function index(int $storeId, #[MapQueryString(serializationContext: ['groups' => ['store_nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($storeId, $dto), context: ['groups' => ['store_nomenclature:index']]);
    }

    #[Route(path: '/{storeId<\d+>}/nomeclatures/{nomenclatureId<\d+>}', methods: ['GET'])]
    public function show(int $storeId, int $nomenclatureId, ShowAction $action): JsonResponse
    {
        return $this->json($action($storeId, $nomenclatureId), context: ['groups' => ['store_nomenclature:show']]);
    }

    #[Route(path: '/{storeId<\d+>}/nomenclatures', methods: ['POST'])]
    public function create(int $storeId, #[MapRequestPayload(serializationContext: ['groups' => ['store_nomenclature:create']], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        return $this->json($action($storeId, $dtos), context: ['groups' => ['store_nomenclature:show']]);
    }

    #[Route('/{storeId<\d+>}/nomeclatures/{nomenclatureId<\d+>}', methods: ['PATCH'])]
    public function update(int $storeId, int $nomenclatureId, #[MapRequestPayload(serializationContext: ['groups' => ['store_nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($storeId, $nomenclatureId, $dto), context: ['groups' => ['store_nomenclature:show']]);
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access denied')]
    #[Route('/{storeId<\d+>}/nomeclatures/{nomenclatureId<\d+>}', methods: ['DELETE'])]
    public function delete(int $storeId, int $nomenclatureId, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($storeId, $nomenclatureId)]);
    }
}
