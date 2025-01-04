<?php

namespace App\Controller;

use App\Action\NomenclatureHistory\CreateAction;
use App\Action\NomenclatureHistory\IndexAction;
use App\Action\NomenclatureHistory\ShowAction;
use App\Dto\NomenclatureHistory\RequestDto;
use App\Dto\NomenclatureHistory\RequestQueryDto;
use App\Entity\User;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route(path: '/api/nomenclature-histories', format: 'json')]
#[OA\Tag(name: 'NomenclatureHistory')]
class NomenclatureHistoryController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['nomenclature_history:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['nomenclature_history:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['nomenclature_history:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['nomenclature_history:create']])] RequestDto $dto, CreateAction $action, #[CurrentUser] User $user): JsonResponse
    {
        return $this->json($action($dto, $user), context: ['groups' => ['nomenclature_history:create']]);
    }
}
