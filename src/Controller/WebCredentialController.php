<?php

namespace App\Controller;

use App\Action\WebCredential\ArticleAction;
use App\Action\WebCredential\CreateAction;
use App\Action\WebCredential\ShowAction;
use App\Action\WebCredential\UpdateAction;
use App\Dto\WebCredential\RequestDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-credentials', format: 'json')]
#[OA\Tag(name: 'WebCredential')]
class WebCredentialController extends AbstractController
{
    #[Route(path: '/{multiStoreId<\d+>}', methods: ['GET'])]
    public function show(int $multiStoreId, ShowAction $action): JsonResponse
    {
        return $this->json($action($multiStoreId), context: ['groups' => ['web_credential:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_credential:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_credential:create']]);
    }

    #[Route(path: '/{multiStoreId<\d+>}', methods: ['POST'])]
    public function increment(int $multiStoreId, ArticleAction $action): JsonResponse
    {
        return $this->json($action($multiStoreId));
    }

    #[Route('/{multiStoreId<\d+>}', methods: ['PATCH'])]
    #[OA\RequestBody(
        description: 'Your request body description',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'category', type: 'string', example: 'category'),
                new OA\Property(
                    property: 'secrets',
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'instagram',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'login', type: 'string', example: 'login'),
                                new OA\Property(property: 'password', type: 'string', example: 'secret'),
                            ]
                        ),
                    ]
                ),
                new OA\Property(
                    property: 'social',
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'telegram',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'url', type: 'string', example: 't.me/url'),
                                new OA\Property(property: 'isActive', type: 'boolean', example: true),
                            ]
                        ),
                        new OA\Property(
                            property: 'facebook',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'url', type: 'string', example: 'facebook.com/url'),
                                new OA\Property(property: 'isActive', type: 'boolean', example: true),
                            ]
                        ),
                    ]
                ),
            ]
        )
    )]
    public function update(int $multiStoreId, #[MapRequestPayload(serializationContext: ['groups' => ['web_credential:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($multiStoreId, $dto), context: ['groups' => ['web_credential:update']]);
    }
}
