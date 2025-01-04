<?php

namespace App\Controller;

use App\Action\Favorite\AssignAction;
use App\Action\Favorite\DetachAction;
use App\Action\Favorite\IndexAction;
use App\Component\CurrentUser;
use App\Entity\WebNomenclature;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/favorites', format: 'json')]
#[OA\Tag(name: 'Favorite')]
class FavoriteController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action, CurrentUser $user): JsonResponse
    {
        return $this->indexResponse($action($user->getId()));
    }

    #[Route('/{web_nomenclature_id<\d+>}/assign', methods: ['POST'])]
    public function assign(int $webNomenclatureId, CurrentUser $user, AssignAction $action): JsonResponse
    {
        $this->existsValidate($webNomenclatureId, WebNomenclature::class);
        $action($webNomenclatureId, $user->getUser());
        
        return $this->emptyResponse();
    }

    #[Route('/{web_nomenclature_id<\d+>}/detach', methods: ['POST'])]
    public function detach(int $webNomenclatureId, CurrentUser $user, DetachAction $action): JsonResponse
    {
        $this->existsValidate($webNomenclatureId, WebNomenclature::class);
        $action($webNomenclatureId, $user->getUser());
        
        return $this->emptyResponse();
    }
}
