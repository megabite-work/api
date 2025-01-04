<?php

namespace App\Controller;

use App\Action\Category\CreateAction;
use App\Action\Category\DeleteAction;
use App\Action\Category\IndexAction;
use App\Action\Category\ShowAction;
use App\Action\Category\UpdateAction;
use App\Controller\AbstractController;
use App\Dto\Category\RequestDto;
use App\Dto\Category\RequestQueryDto;
use App\Entity\Category;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/categories', format: 'json')]
#[OA\Tag(name: 'Category')]
class CategoryController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['category:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, Category::class);
        
        return $this->successResponse($action($id), Response::HTTP_OK);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['category:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['category:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, Category::class);
        
        return $this->successResponse($action($id, $dto), Response::HTTP_OK);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, Category::class);
        $action($id);
        
        return $this->emptyResponse();
    }
}
